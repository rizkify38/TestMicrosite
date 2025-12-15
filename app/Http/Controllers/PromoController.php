<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Voucher;
use App\Services\BarcodeService;
use Carbon\Carbon;

class PromoController extends Controller
{
    protected $barcodeService;

    public function __construct(BarcodeService $barcodeService)
    {
        $this->barcodeService = $barcodeService;
    }

    public function homepage()
    {
        return view('homepage');
    }

    public function promo()
    {
        return view('promo');
    }

    public function selectProduct(Request $request)
    {
        // Validasi produk yang dipilih
        $request->validate([
            'product_type' => 'required|in:kecap,sambal',
            'product_name' => 'required|string'
        ]);

        // Simpan data produk ke session
        session([
            'selected_product' => [
                'type' => $request->product_type,
                'name' => $request->product_name
            ]
        ]);

        return redirect()->route('form');
    }

    public function showForm()
    {
        // Cek jika ada produk yang dipilih
        if (!session()->has('selected_product')) {
            return redirect()->route('promo')->with('error', 'Silakan pilih produk terlebih dahulu');
        }

        $selectedProduct = session('selected_product');
        
        return view('form', compact('selectedProduct'));
    }

    public function submitVoucher(Request $request)
    {
        // Validasi form
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'nomor_telepon' => 'required|string|max:15',
            'email' => 'required|email',
            'syarat' => 'required|accepted'
        ]);

        // CHECK OTP VERIFICATION FIRST
        $otpService = app(\App\Services\OtpService::class);
        $email = strtolower(trim($request->email));
        
        if (!$otpService->isEmailVerified($email)) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['email' => 'Email belum diverifikasi. Silakan verifikasi email dengan OTP terlebih dahulu.']);
        }

        // STRICT EMAIL DOMAIN VALIDATION
        // Hanya allow email dari domain yang sudah ditentukan
        $email = strtolower(trim($request->email));
        
        // Safety check: pastikan email valid format
        if (!str_contains($email, '@')) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['email' => 'Format email tidak valid.']);
        }
        
        // Extract domain dari email
        [$username, $domain] = explode('@', $email);
        
        // Whitelist domain yang diperbolehkan
        $allowedDomains = [
            'gmail.com',
            'yahoo.com',
            'yahoo.co.id',
            'outlook.com',
            'hotmail.com',
            'icloud.com',
            'live.com',
            'aol.com',
        ];
        
        // Cek apakah domain ada di whitelist
        if (!in_array($domain, $allowedDomains)) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['email' => 'Email harus menggunakan domain yang valid (gmail.com, yahoo.com, outlook.com, dll). Domain "' . $domain . '" tidak diperbolehkan.']);
        }
        
        // Cek apakah email exact match sudah ada (unique constraint)
        $exactMatch = \App\Models\VoucherClaim::where('customer_email', $email)->exists();
        if ($exactMatch) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['email' => 'Email ini sudah pernah mendapatkan voucher. Satu email hanya bisa mendapatkan satu voucher.']);
        }
        
        // Normalize dan cek nomor telepon
        $phone = preg_replace('/[^0-9]/', '', $request->nomor_telepon); // Remove non-numeric
        $phoneExists = \App\Models\VoucherClaim::whereRaw('REPLACE(REPLACE(REPLACE(customer_phone, " ", ""), "-", ""), "+", "") = ?', [$phone])->exists();
        if ($phoneExists) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['nomor_telepon' => 'Nomor telepon ini sudah pernah mendapatkan voucher. Satu nomor telepon hanya bisa mendapatkan satu voucher.']);
        }
        
        // Normalize dan cek nama lengkap (case-insensitive, trim whitespace)
        $name = strtolower(trim($request->nama_lengkap));
        $nameExists = \App\Models\VoucherClaim::whereRaw('LOWER(TRIM(customer_name)) = ?', [$name])->exists();
        if ($nameExists) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['nama_lengkap' => 'Nama ini sudah pernah mendapatkan voucher. Satu nama hanya bisa mendapatkan satu voucher.']);
        }

        // Cek jika ada produk yang dipilih
        if (!session()->has('selected_product')) {
            return redirect()->route('promo')->with('error', 'Sesi produk telah habis, silakan pilih ulang');
        }

        $selectedProduct = session('selected_product');

        try {
            // Wrap dalam transaction untuk data consistency
            $voucherCode = \DB::transaction(function () use ($request, $selectedProduct) {
                // Cari voucher code yang belum di-claim (sequential order)
                $voucherCode = \App\Models\VoucherCode::unclaimed()
                                ->byProductType($selectedProduct['type'])
                                ->orderBy('id', 'asc')
                                ->lockForUpdate() // Lock row untuk prevent race condition
                                ->first();

                // Jika voucher code habis
                if (!$voucherCode) {
                    throw new \Exception('Voucher habis');
                }

                // Mark code as claimed
                $voucherCode->update([
                    'is_claimed' => true,
                    'claimed_at' => now(),
                ]);

                // Generate barcode FIRST (sebelum create claim)
                // Jika barcode gagal, transaction akan rollback
                $barcodePath = $this->barcodeService->generateVoucherBarcode($voucherCode->code);

                // Create voucher claim record dengan barcode path
                $claim = \App\Models\VoucherClaim::create([
                    'voucher_code_id' => $voucherCode->id,
                    'customer_name' => $request->nama_lengkap,
                    'customer_email' => $request->email,
                    'customer_phone' => $request->nomor_telepon,
                    'product_type' => $selectedProduct['type'],
                    'product_name' => $selectedProduct['name'],
                    'barcode_path' => $barcodePath,
                    'expired_at' => Carbon::now()->addDay(), // 1x24 jam (1 hari) dari sekarang
                ]);

                return $voucherCode;
            });

            // Hapus session produk setelah berhasil submit
            session()->forget('selected_product');

            return redirect()->route('success', ['code' => $voucherCode->code]);

        } catch (\Exception $e) {
            // Handle error
            if ($e->getMessage() === 'Voucher habis') {
                return redirect()->route('promo')->with('error', 'Maaf, voucher untuk produk ini sudah habis. Silakan coba produk lainnya.');
            }

            // Handle barcode generation errors
            if (str_contains($e->getMessage(), 'Barcode generation failed')) {
                \Log::error('Barcode generation error: ' . $e->getMessage());
                \Log::error($e->getTraceAsString());
                return redirect()->route('form')->with('error', 'Terjadi kesalahan saat membuat barcode. Silakan coba lagi atau hubungi admin.');
            }

            // Log unexpected errors
            \Log::error('Error submitting voucher: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());

            return redirect()->route('form')->with('error', 'Terjadi kesalahan saat memproses voucher. Silakan coba lagi.');
        }
    }

    public function success($code)
    {
        // Load voucher claim dari database via voucher code
        $voucherCode = \App\Models\VoucherCode::where('code', $code)->first();
        
        if (!$voucherCode || !$voucherCode->claim) {
            return redirect()->route('homepage')->with('error', 'Voucher tidak ditemukan');
        }

        $claim = $voucherCode->claim;

        // Format data untuk view (kompatibel dengan view yang sudah ada)
        $data = [
            'nama' => $claim->customer_name,
            'telepon' => $claim->customer_phone,
            'email' => $claim->customer_email,
            'voucher_code' => $voucherCode->code,
            'nominal' => 'Rp 5.000',
            'expired_date' => $claim->expired_at->format('d F Y'),
            'product_type' => $claim->product_type,
            'product' => $claim->product_name,
            'barcode_path' => $claim->barcode_path,
        ];

        return view('success', compact('data'));
    }
}
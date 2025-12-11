<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PromoController extends Controller
{
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

        // Cek jika ada produk yang dipilih
        if (!session()->has('selected_product')) {
            return redirect()->route('promo')->with('error', 'Sesi produk telah habis, silakan pilih ulang');
        }

        $selectedProduct = session('selected_product');

        // Generate kode voucher unik (12 digit)
        $voucherCode = strtoupper(Str::random(12));
        
        // Simpan data ke session
        session([
            'voucher_data' => [
                'nama' => $request->nama_lengkap,
                'telepon' => $request->nomor_telepon,
                'email' => $request->email,
                'voucher_code' => $voucherCode,
                'nominal' => 'Rp 5.000',
                'expired_date' => '16 Februari 2026',
                'product_type' => $selectedProduct['type'],
                'product_name' => $selectedProduct['name']
            ]
        ]);

        // Hapus session produk setelah berhasil submit
        session()->forget('selected_product');

        return redirect()->route('success', ['code' => $voucherCode]);
    }

    public function success($code)
    {
        $data = session('voucher_data', []);
        
        if (empty($data)) {
            return redirect()->route('homepage');
        }

        return view('success', compact('data'));
    }
}
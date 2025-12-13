@extends('layouts.app')

@section('title', 'Voucher Berhasil - PromoMurahABC')

@section('content')
<div class="min-h-screen py-6 sm:py-10 px-4">
    <div class="container-custom max-w-3xl">
        <!-- Success Icon -->
        <div class="text-center mb-6 sm:mb-8 animate-fade-in-up">
            <div class="inline-flex items-center justify-center w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-green-400 to-green-600 rounded-full mb-4 shadow-2xl animate-pulse-slow">
                <i class="fas fa-check text-white text-4xl sm:text-5xl"></i>
            </div>
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-gray-900 mb-3">
                Selamat! 🎉
            </h1>
            <p class="text-base sm:text-lg lg:text-xl text-gray-700">
                Anda mendapatkan potongan voucher sebesar <span class="font-extrabold abc-red">{{ $data['nominal'] }}</span>
            </p>
        </div>
        
        <!-- Voucher Card -->
        <div class="card-modern p-6 sm:p-8 lg:p-10 mb-6 bg-gradient-to-br from-red-50 via-orange-50 to-yellow-50 border-2 border-red-200 animate-fade-in-up" style="animation-delay: 0.1s">
            <!-- Product Info -->
            <div class="bg-white rounded-xl p-4 mb-6 shadow-md">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-abc rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-shopping-bag text-white text-xl"></i>
                    </div>
                    <div>
                        <p class="text-xs sm:text-sm text-gray-600">Voucher berlaku untuk:</p>
                        <p class="text-base sm:text-lg font-bold abc-red">{{ $data['product'] }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Voucher Code -->
            <div class="text-center mb-6">
                <p class="text-sm text-gray-600 mb-3 font-medium">Kode Voucher</p>
                <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-lg border-2 border-dashed border-red-300">
                    <p class="text-2xl sm:text-3xl lg:text-4xl font-extrabold abc-red tracking-wider break-all">
                        {{ $data['voucher_code'] }}
                    </p>
                </div>
            </div>
            
            <!-- Barcode/QR Code - LARGE SIZE -->
            <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 sm:p-8 mb-6 shadow-inner">
                @if(isset($data['barcode_path']) && $data['barcode_path'])
                    <div class="flex justify-center mb-4">
                        <img 
                            src="{{ asset('storage/' . $data['barcode_path']) }}" 
                            alt="Barcode {{ $data['voucher_code'] }}"
                            class="w-full max-w-md h-auto"
                        >
                    </div>
                @else
                    <div class="barcode text-center text-6xl sm:text-7xl lg:text-8xl mb-4">
                        *{{ $data['voucher_code'] }}*
                    </div>
                @endif
                <div class="text-center">
                    <p class="text-sm sm:text-base font-bold text-gray-700 mb-1">
                        <i class="fas fa-qrcode mr-2 abc-red"></i> Scan barcode di kasir Alfamart
                    </p>
                    <p class="text-xs sm:text-sm text-gray-600">Tunjukkan kode ini untuk mendapatkan potongan harga</p>
                </div>
            </div>
            
            <!-- Voucher Details Grid -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="bg-white rounded-xl p-4 shadow-md text-center">
                    <p class="text-xs text-gray-600 mb-1">Nominal Voucher</p>
                    <p class="text-lg sm:text-xl font-extrabold abc-red">{{ $data['nominal'] }}</p>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-md text-center">
                    <p class="text-xs text-gray-600 mb-1">Berlaku Hingga</p>
                    <p class="text-lg sm:text-xl font-extrabold text-gray-800">{{ $data['expired_date'] }}</p>
                </div>
            </div>
        </div>
        
        <!-- Customer Info -->
        <div class="card-modern p-6 sm:p-8 mb-6 animate-fade-in-up" style="animation-delay: 0.2s">
            <h3 class="text-lg sm:text-xl font-extrabold text-gray-900 mb-5 flex items-center">
                <i class="fas fa-user-circle abc-red mr-3 text-2xl"></i>
                Data Penerima Voucher
            </h3>
            
            <div class="space-y-4">
                <div class="flex items-start gap-3 pb-4 border-b border-gray-100">
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-user abc-red"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-gray-500 mb-0.5">Nama Lengkap</p>
                        <p class="font-semibold text-gray-900">{{ $data['nama'] }}</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-3 pb-4 border-b border-gray-100">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-envelope text-blue-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-gray-500 mb-0.5">Email</p>
                        <p class="font-semibold text-gray-900 break-all">{{ $data['email'] }}</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-phone text-green-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-gray-500 mb-0.5">Nomor Telepon</p>
                        <p class="font-semibold text-gray-900">{{ $data['telepon'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Instructions -->
        <div class="card-modern p-6 sm:p-8 bg-gradient-to-br from-blue-50 to-indigo-50 border-2 border-blue-200 mb-6 animate-fade-in-up" style="animation-delay: 0.3s">
            <h4 class="text-lg sm:text-xl font-extrabold text-blue-900 mb-5 flex items-center">
                <i class="fas fa-info-circle mr-3 text-2xl"></i>
                Cara Menggunakan Voucher
            </h4>
            <ol class="space-y-3">
                <li class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center flex-shrink-0 font-bold text-sm">1</div>
                    <p class="text-sm sm:text-base text-blue-900 pt-1">Belanja produk <span class="font-bold">{{ $data['product'] }}</span> di Alfamart terdekat</p>
                </li>
                <li class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center flex-shrink-0 font-bold text-sm">2</div>
                    <p class="text-sm sm:text-base text-blue-900 pt-1">Tunjukkan barcode atau kode voucher ini kepada kasir</p>
                </li>
                <li class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center flex-shrink-0 font-bold text-sm">3</div>
                    <p class="text-sm sm:text-base text-blue-900 pt-1">Dapatkan potongan harga <span class="font-bold">{{ $data['nominal'] }}</span></p>
                </li>
                <li class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center flex-shrink-0 font-bold text-sm">4</div>
                    <p class="text-sm sm:text-base text-blue-900 pt-1">Voucher hanya berlaku di Alfamart terdekat</p>
                </li>
            </ol>
        </div>
        
        <!-- Action Buttons -->
        <div class="space-y-4 animate-fade-in-up" style="animation-delay: 0.4s">
            <button 
                onclick="window.print()" 
                class="btn-primary w-full py-4 rounded-xl text-base sm:text-lg font-bold no-print"
            >
                <i class="fas fa-print mr-2"></i> Cetak Voucher
            </button>
            
            <a 
                href="{{ route('homepage') }}" 
                class="block w-full py-4 px-6 border-2 border-gray-300 rounded-xl text-center text-gray-700 font-bold hover:bg-gray-50 transition-colors no-print"
            >
                <i class="fas fa-home mr-2"></i> Kembali ke Beranda
            </a>
        </div>
        
        <!-- Brand Footer -->
        <div class="text-center mt-10 pt-8 border-t border-gray-200 animate-fade-in-up" style="animation-delay: 0.5s">
            <h2 class="text-2xl sm:text-3xl font-extrabold abc-red mb-2">ABC</h2>
            <p class="text-base sm:text-lg font-bold text-gray-800 mb-4">Ahlinya Buat Citarasa</p>
            <p class="text-xs sm:text-sm text-gray-500">© 2025 PromoMurahABC. Semua hak dilindungi.</p>
        </div>
    </div>
</div>

<style>
    @media print {
        body {
            background: white;
        }
        .no-print {
            display: none !important;
        }
        .card-modern {
            box-shadow: none;
            border: 1px solid #ddd;
        }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
<script>
    // Confetti celebration
    confetti({
        particleCount: 150,
        spread: 70,
        origin: { y: 0.6 },
        colors: ['#E31E24', '#FFD700', '#FFA500']
    });
    
    setTimeout(() => {
        confetti({
            particleCount: 100,
            spread: 60,
            origin: { y: 0.7 }
        });
    }, 300);
</script>
@endsection
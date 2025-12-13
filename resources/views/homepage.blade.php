@extends('layouts.app')

@section('title', 'PromoMurahABC - Tebus Voucher Potongan')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-8 sm:py-12">
    <div class="container-custom max-w-5xl">
        <!-- Main Content -->
        <div class="text-center space-y-8 sm:space-y-12">
            <!-- Hero Image -->
            <div class="animate-fade-in-up">
                <div class="card-modern inline-block w-full max-w-4xl float-animation">
                    <img 
                        src="{{ asset('images/Homepage.jpg') }}" 
                        alt="PromoMurahABC - Tebus Voucher Potongan Rp 5.000"
                        class="w-full h-auto"
                        loading="eager"
                    >
                </div>
            </div>
            
            <!-- CTA Section -->
            <div class="animate-fade-in-up space-y-6">
                <!-- Main CTA Button -->
                <div>
                    <a href="{{ route('promo') }}" 
                       class="btn-primary inline-flex items-center justify-center gap-3 text-base sm:text-xl md:text-2xl px-8 sm:px-12 md:px-16 py-4 sm:py-5 md:py-6 animate-pulse-slow">
                        <span class="font-extrabold">Dapatkan Voucher Di Sini</span>
                        <i class="fas fa-arrow-right text-lg sm:text-xl"></i>
                    </a>
                </div>
                
                <!-- Description -->
                <div class="max-w-2xl mx-auto px-4">
                    <p class="text-gray-600 text-sm sm:text-base md:text-lg leading-relaxed">
                        Klik tombol di atas untuk memilih produk favorit Anda dan dapatkan voucher potongan <span class="font-bold abc-red">Rp 5.000</span>
                    </p>
                </div>
                
                <!-- Features -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 max-w-3xl mx-auto mt-8">
                    <div class="card-modern p-4 sm:p-6">
                        <div class="text-3xl sm:text-4xl mb-3">🎁</div>
                        <h3 class="font-bold text-sm sm:text-base mb-2">Voucher Gratis</h3>
                        <p class="text-xs sm:text-sm text-gray-600">Potongan Rp 5.000</p>
                    </div>
                    <div class="card-modern p-4 sm:p-6">
                        <div class="text-3xl sm:text-4xl mb-3">⚡</div>
                        <h3 class="font-bold text-sm sm:text-base mb-2">Proses Cepat</h3>
                        <p class="text-xs sm:text-sm text-gray-600">Langsung dapat kode</p>
                    </div>
                    <div class="card-modern p-4 sm:p-6">
                        <div class="text-3xl sm:text-4xl mb-3">🏪</div>
                        <h3 class="font-bold text-sm sm:text-base mb-2">Alfamart</h3>
                        <p class="text-xs sm:text-sm text-gray-600">Berlaku di semua toko</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        .btn-primary {
            display: none;
        }
    }
</style>
@endsection
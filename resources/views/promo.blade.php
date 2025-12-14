@extends('layouts.app')

@section('title', 'Pilih Produk - PromoMurahABC')

@section('content')
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

<div class="min-h-screen py-4 sm:py-10 px-4">
    <div class="container-custom max-w-7xl">
        <!-- Header Images - SLIDER -->
        <div class="mb-6 sm:mb-12 animate-fade-in-up">
            <div class="swiper bannerSwiper rounded-2xl sm:rounded-3xl overflow-hidden shadow-xl">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img 
                            src="{{ asset('images/Head.jpg') }}"
                            alt="PromoMurahABC"
                            class="w-full h-auto">
                    </div>
                    <div class="swiper-slide">
                        <img 
                            src="{{ asset('images/Head2.jpg') }}"
                            alt="Voucher Rp 5.000"
                            class="w-full h-auto">
                    </div>
                </div>
                <!-- Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Navigation -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
        
        <!-- Title Section -->
        <div class="text-center mb-6 sm:mb-12 animate-fade-in-up" style="animation-delay: 0.2s">
            <h2 class="text-lg sm:text-2xl lg:text-3xl font-extrabold text-gray-900 mb-2">
                Pilih Produk Favorit Anda
            </h2>
            <p class="text-sm sm:text-base lg:text-lg text-gray-600 max-w-2xl mx-auto">
                Pilih salah satu produk untuk mendapatkan voucher potongan <span class="font-bold abc-red">Rp 5.000</span>
            </p>
        </div>

        <!-- Products Grid - OPTIMIZED FOR MOBILE -->
        <div class="grid grid-cols-2 gap-3 sm:gap-6 lg:gap-8 mb-8 sm:mb-12">
            <!-- Product 1 - Sambal Asli -->
            <div class="product-card animate-fade-in-up" style="animation-delay: 0.3s">
                <div class="p-2 sm:p-4">
                    <img
                        src="{{ asset('images/Product1.png') }}"
                        alt="ABC Sambal Asli"
                        class="w-20 h-32 sm:w-32 sm:h-48 lg:w-40 lg:h-56 mx-auto object-contain">
                </div>
                
                <div class="p-3 sm:p-6 lg:p-8">
                    <h3 class="text-sm sm:text-xl lg:text-2xl font-extrabold abc-red mb-1 sm:mb-3">
                        ABC SAMBAL ASLI
                    </h3>
                    <p class="text-xs sm:text-sm lg:text-base text-gray-700 mb-2 sm:mb-4 hidden sm:block">
                        Dibuat Ala Traditional - Rasa otentik warisan Indonesia
                    </p>

                    <div class="flex flex-wrap gap-1 sm:gap-2 mb-3 sm:mb-6">
                        <span class="bg-gray-100 px-2 py-1 rounded-lg text-xs font-bold text-gray-800">
                            335g
                        </span>
                        <span class="bg-green-100 px-2 py-1 rounded-lg text-xs font-bold text-green-800">
                            HALAL
                        </span>
                        <span class="bg-red-50 px-2 py-1 rounded-lg text-xs font-bold abc-red border border-red-200">
                            Pedas
                        </span>
                    </div>

                    <button
                        onclick="selectProduct('sambal', 'ABC Sambal Asli', this)"
                        class="btn-primary w-full text-xs sm:text-base lg:text-lg py-2 sm:py-3 lg:py-4 rounded-lg sm:rounded-xl"
                        data-product="sambal">
                        <i class="fas fa-pepper-hot mr-1 sm:mr-2"></i> <span class="hidden sm:inline">Pilih </span>Sambal
                    </button>
                </div>
            </div>

            <!-- Product 2 - Kecap Manis -->
            <div class="product-card animate-fade-in-up" style="animation-delay: 0.4s">
                <div class="p-2 sm:p-4">
                    <img
                        src="{{ asset('images/Product2.png') }}"
                        alt="ABC Kecap Manis"
                        class="w-20 h-32 sm:w-32 sm:h-48 lg:w-40 lg:h-56 mx-auto object-contain">
                </div>

                <div class="p-3 sm:p-6 lg:p-8">
                    <h3 class="text-sm sm:text-xl lg:text-2xl font-extrabold abc-red mb-1 sm:mb-3">
                        ABC KECAP MANIS
                    </h3>
                    <p class="text-xs sm:text-sm lg:text-base text-gray-700 mb-2 sm:mb-4 hidden sm:block">
                        2X Fermentasi - Rasa lebih Gurih dan Kental
                    </p>

                    <div class="flex flex-wrap gap-1 sm:gap-2 mb-3 sm:mb-6">
                        <span class="bg-gray-100 px-2 py-1 rounded-lg text-xs font-bold text-gray-800">
                            685g
                        </span>
                        <span class="bg-green-100 px-2 py-1 rounded-lg text-xs font-bold text-green-800">
                            HALAL
                        </span>
                        <span class="bg-yellow-50 px-2 py-1 rounded-lg text-xs font-bold text-yellow-800 border border-yellow-200">
                            2X Fermentasi
                        </span>
                    </div>

                    <button
                        onclick="selectProduct('kecap', 'ABC Kecap Manis', this)"
                        class="btn-primary w-full text-xs sm:text-base lg:text-lg py-2 sm:py-3 lg:py-4 rounded-lg sm:rounded-xl"
                        data-product="kecap">
                        <i class="fas fa-wine-bottle mr-1 sm:mr-2"></i> <span class="hidden sm:inline">Pilih </span>Kecap
                    </button>
                </div>
            </div>
        </div>

        <!-- Brand Section -->
        <div class="text-center py-6 sm:py-12 border-t border-gray-200 animate-fade-in-up" style="animation-delay: 0.5s">
            <h2 class="text-xl sm:text-3xl lg:text-4xl font-extrabold abc-red mb-2">ABC</h2>
            <p class="text-base sm:text-xl lg:text-2xl font-bold text-gray-800">Ahlinya Buat Citarasa</p>
        </div>
    </div>
</div>

<!-- Selected Product Floating Bar -->
<div id="selectedProductIndicator" class="fixed bottom-0 left-0 right-0 bg-white border-t-4 border-abc-red shadow-2xl p-3 sm:p-6 hidden z-50 transform translate-y-full transition-all duration-300">
    <div class="container-custom max-w-4xl">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-4">
            <div class="flex items-center gap-3 flex-1">
                <div class="w-10 h-10 sm:w-14 sm:h-14 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-shopping-bag text-abc-red text-lg sm:text-2xl"></i>
                </div>
                <div class="text-center sm:text-left">
                    <p class="text-xs sm:text-sm text-gray-600">Produk yang dipilih:</p>
                    <h3 id="selectedProductName" class="text-sm sm:text-xl font-bold abc-red"></h3>
                </div>
            </div>
            
            <div class="flex gap-2 sm:gap-3 w-full sm:w-auto">
                <button
                    onclick="clearSelection()"
                    class="flex-1 sm:flex-none px-3 sm:px-6 py-2 sm:py-3 border-2 border-gray-300 rounded-lg sm:rounded-xl text-xs sm:text-base text-gray-700 font-semibold hover:bg-gray-50 transition-colors">
                    <i class="fas fa-edit mr-1 sm:mr-2"></i> Ubah
                </button>

                <form id="productForm" action="{{ route('select-product') }}" method="POST" class="flex-1 sm:flex-none">
                    @csrf
                    <input type="hidden" id="product_type" name="product_type" value="">
                    <input type="hidden" id="product_name" name="product_name" value="">

                    <button
                        type="submit"
                        id="continueButton"
                        class="btn-primary w-full px-4 sm:px-8 py-2 sm:py-3 rounded-lg sm:rounded-xl text-xs sm:text-base font-bold">
                        <i class="fas fa-arrow-right mr-1 sm:mr-2"></i> Lanjut
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    // Initialize Swiper
    const swiper = new Swiper('.bannerSwiper', {
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

    let selectedProduct = null;

    function selectProduct(type, name, button) {
        selectedProduct = {
            type,
            name
        };

        // Update hidden form fields
        document.getElementById('product_type').value = type;
        document.getElementById('product_name').value = name;
        document.getElementById('selectedProductName').textContent = name;

        // Remove selection from all buttons
        document.querySelectorAll('.product-card button').forEach(btn => {
            btn.classList.remove('opacity-50');
            const isSambal = btn.getAttribute('data-product') === 'sambal';
            btn.innerHTML = isSambal ?
                '<i class="fas fa-pepper-hot mr-1 sm:mr-2"></i> <span class="hidden sm:inline">Pilih </span>Sambal' :
                '<i class="fas fa-wine-bottle mr-1 sm:mr-2"></i> <span class="hidden sm:inline">Pilih </span>Kecap';
        });

        // Mark selected button
        button.classList.add('opacity-50');
        button.innerHTML = '<i class="fas fa-check-circle mr-1 sm:mr-2"></i> Terpilih';

        // Show floating indicator
        const indicator = document.getElementById('selectedProductIndicator');
        indicator.classList.remove('hidden');
        setTimeout(() => {
            indicator.classList.remove('translate-y-full');
        }, 10);
    }

    function clearSelection() {
        selectedProduct = null;

        // Reset form
        document.getElementById('product_type').value = '';
        document.getElementById('product_name').value = '';

        // Reset buttons
        document.querySelectorAll('.product-card button').forEach(btn => {
            btn.classList.remove('opacity-50');
            const isSambal = btn.getAttribute('data-product') === 'sambal';
            btn.innerHTML = isSambal ?
                '<i class="fas fa-pepper-hot mr-1 sm:mr-2"></i> <span class="hidden sm:inline">Pilih </span>Sambal' :
                '<i class="fas fa-wine-bottle mr-1 sm:mr-2"></i> <span class="hidden sm:inline">Pilih </span>Kecap';
        });

        // Hide indicator
        const indicator = document.getElementById('selectedProductIndicator');
        indicator.classList.add('translate-y-full');
        setTimeout(() => {
            indicator.classList.add('hidden');
        }, 300);
    }
</script>

<style>
    /* Swiper custom styling */
    .swiper-button-next,
    .swiper-button-prev {
        color: #E31E24;
        background: white;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 16px;
    }
    
    .swiper-pagination-bullet-active {
        background: #E31E24;
    }
    
    @media (max-width: 640px) {
        .swiper-button-next,
        .swiper-button-prev {
            width: 28px;
            height: 28px;
        }
        
        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 12px;
        }
    }
</style>
@endsection

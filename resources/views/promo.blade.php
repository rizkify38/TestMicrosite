@extends('layouts.app')

@section('title', 'Pilih Produk - PromoMurahABC')

@section('content')
<div class="min-h-screen py-6 sm:py-10 px-4">
    <div class="container-custom max-w-7xl">
        <!-- Header Images -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 mb-8 sm:mb-12">
            <div class="card-modern animate-fade-in-up">
                <img
                    src="{{ asset('images/Head.jpg') }}"
                    alt="PromoMurahABC"
                    class="w-full h-auto">
            </div>
            <div class="card-modern animate-fade-in-up" style="animation-delay: 0.1s">
                <img
                    src="{{ asset('images/Head2.jpg') }}"
                    alt="Voucher Rp 5.000"
                    class="w-full h-auto">
            </div>
        </div>

        <!-- Title Section -->
        <div class="text-center mb-8 sm:mb-12 animate-fade-in-up" style="animation-delay: 0.2s">
            <h2 class="text-responsive-lg font-extrabold text-gray-900 mb-3">
                Pilih Produk Favorit Anda
            </h2>
            <p class="text-responsive-base text-gray-600 max-w-2xl mx-auto">
                Pilih salah satu produk untuk mendapatkan voucher potongan <span class="font-bold abc-red">Rp 5.000</span>
            </p>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 mb-12">
            <!-- Product 1 - Sambal Asli -->
            <div class="product-card animate-fade-in-up" style="animation-delay: 0.3s">
                <div class="p-2 sm:p-4">
                    <img
                        src="{{ asset('images/Product1.png') }}"
                        alt="ABC Sambal Asli"
                        class="w-32 h-64 mx-auto">
                </div>

                <div class="p-4 sm:p-6 lg:p-8">
                    <h3 class="text-xl sm:text-2xl lg:text-3xl font-extrabold abc-red mb-3">
                        ABC SAMBAL ASLI
                    </h3>
                    <p class="text-sm sm:text-base text-gray-700 mb-4">
                        Dibuat Ala Traditional - Rasa otentik warisan Indonesia
                    </p>

                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="bg-gray-100 px-3 py-1.5 rounded-lg text-xs sm:text-sm font-bold text-gray-800">
                            BERAT BERSIH 335g
                        </span>
                        <span class="bg-green-100 px-3 py-1.5 rounded-lg text-xs sm:text-sm font-bold text-green-800">
                            HALAL
                        </span>
                        <span class="bg-red-50 px-3 py-1.5 rounded-lg text-xs sm:text-sm font-bold abc-red border border-red-200">
                            Pedas Sedang
                        </span>
                    </div>

                    <button
                        onclick="selectProduct('sambal', 'ABC Sambal Asli', this)"
                        class="btn-primary w-full text-sm sm:text-base lg:text-lg py-3 sm:py-4 rounded-xl sm:rounded-2xl"
                        data-product="sambal">
                        <i class="fas fa-pepper-hot mr-2"></i> Pilih Sambal Asli
                    </button>
                </div>
            </div>

            <!-- Product 2 - Kecap Manis -->
            <div class="product-card animate-fade-in-up" style="animation-delay: 0.4s">
                <div class="p-2 sm:p-4">
                    <img
                        src="{{ asset('images/Product2.png') }}"
                        alt="ABC Kecap Manis"
                        class="w-64 h-64 mx-auto">
                </div>

                <div class="p-4 sm:p-6 lg:p-8">
                    <h3 class="text-xl sm:text-2xl lg:text-3xl font-extrabold abc-red mb-3">
                        ABC KECAP MANIS
                    </h3>
                    <p class="text-sm sm:text-base text-gray-700 mb-4">
                        2X Fermentasi - Rasa lebih Gurih dan Kental
                    </p>

                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="bg-gray-100 px-3 py-1.5 rounded-lg text-xs sm:text-sm font-bold text-gray-800">
                            BERAT BERSIH 685g
                        </span>
                        <span class="bg-green-100 px-3 py-1.5 rounded-lg text-xs sm:text-sm font-bold text-green-800">
                            HALAL
                        </span>
                        <span class="bg-yellow-50 px-3 py-1.5 rounded-lg text-xs sm:text-sm font-bold text-yellow-800 border border-yellow-200">
                            2X Fermentasi
                        </span>
                    </div>

                    <button
                        onclick="selectProduct('kecap', 'ABC Kecap Manis', this)"
                        class="btn-primary w-full text-sm sm:text-base lg:text-lg py-3 sm:py-4 rounded-xl sm:rounded-2xl"
                        data-product="kecap">
                        <i class="fas fa-wine-bottle mr-2"></i> Pilih Kecap Manis
                    </button>
                </div>
            </div>
        </div>

        <!-- Brand Section -->
        <div class="text-center py-8 sm:py-12 border-t border-gray-200 animate-fade-in-up" style="animation-delay: 0.5s">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold abc-red mb-2">ABC</h2>
            <p class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-800">Ahlinya Buat Citarasa</p>
        </div>
    </div>
</div>

<!-- Selected Product Floating Bar -->
<div id="selectedProductIndicator" class="fixed bottom-0 left-0 right-0 bg-white border-t-4 border-abc-red shadow-2xl p-4 sm:p-6 hidden z-50 transform translate-y-full transition-all duration-300">
    <div class="container-custom max-w-4xl">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-4 flex-1">
                <div class="w-12 h-12 sm:w-14 sm:h-14 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-shopping-bag text-abc-red text-xl sm:text-2xl"></i>
                </div>
                <div class="text-center sm:text-left">
                    <p class="text-xs sm:text-sm text-gray-600">Produk yang dipilih:</p>
                    <h3 id="selectedProductName" class="text-base sm:text-xl font-bold abc-red"></h3>
                </div>
            </div>

            <div class="flex gap-3 w-full sm:w-auto">
                <button
                    onclick="clearSelection()"
                    class="flex-1 sm:flex-none px-4 sm:px-6 py-2.5 sm:py-3 border-2 border-gray-300 rounded-xl text-sm sm:text-base text-gray-700 font-semibold hover:bg-gray-50 transition-colors">
                    <i class="fas fa-edit mr-2"></i> Ubah
                </button>

                <form id="productForm" action="{{ route('select-product') }}" method="POST" class="flex-1 sm:flex-none">
                    @csrf
                    <input type="hidden" id="product_type" name="product_type" value="">
                    <input type="hidden" id="product_name" name="product_name" value="">

                    <button
                        type="submit"
                        id="continueButton"
                        class="btn-primary w-full px-6 sm:px-8 py-2.5 sm:py-3 rounded-xl text-sm sm:text-base font-bold">
                        <i class="fas fa-arrow-right mr-2"></i> Lanjut ke Form
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
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
            btn.innerHTML = btn.getAttribute('data-product') === 'sambal' ?
                '<i class="fas fa-pepper-hot mr-2"></i> Pilih Sambal Asli' :
                '<i class="fas fa-wine-bottle mr-2"></i> Pilih Kecap Manis';
        });

        // Mark selected button
        button.classList.add('opacity-50');
        button.innerHTML = '<i class="fas fa-check-circle mr-2"></i> Terpilih';

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
            btn.innerHTML = btn.getAttribute('data-product') === 'sambal' ?
                '<i class="fas fa-pepper-hot mr-2"></i> Pilih Sambal Asli' :
                '<i class="fas fa-wine-bottle mr-2"></i> Pilih Kecap Manis';
        });

        // Hide indicator
        const indicator = document.getElementById('selectedProductIndicator');
        indicator.classList.add('translate-y-full');
        setTimeout(() => {
            indicator.classList.add('hidden');
        }, 300);
    }
</script>
@endsection
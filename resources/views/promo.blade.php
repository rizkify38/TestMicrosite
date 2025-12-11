@extends('layouts.app')

@section('title', 'Pilih Produk - PromoMurahABC')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header dengan promo Head dan Head2 berdampingan -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Head.jpg -->
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300">
            <img 
                src="{{ asset('images/Head.jpg') }}" 
                alt="PromoMurahABC Tebus Voucher Potongan Rp 5.000"
                class="w-full h-auto max-w-full object-cover"
            >
        </div>
        
        <!-- Head2.jpg -->
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300">
            <img 
                src="{{ asset('images/Head2.jpg') }}" 
                alt="PromoMurahABC Voucher Rp 5.000"
                class="w-full h-auto max-w-full object-cover"
            >
        </div>
    </div>
    
    <!-- Section Pilih Produk -->
    <div class="text-center mb-8">
        <h2 class="section-title text-3xl mb-2">Pilih Produk Favorit Anda</h2>
        <p class="text-gray-600 text-lg">Pilih salah satu produk untuk mendapatkan voucher Rp 5.000</p>
    </div>
    
    <!-- Products dengan Product1 dan Product2 berdampingan -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
        <!-- Product 1 - Sambal Asli -->
        <div class="product-card bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
            <div class="p-1">
                <img 
                    src="{{ asset('images/Product1.png') }}" 
                    alt="ABC Sambal Asli"
                    class="w-full h-auto max-w-full object-contain"
                >
            </div>
            
            <div class="p-6">
                <h3 class="text-2xl font-bold abc-red mb-3">ABC SAMBAL ASLI</h3>
                <p class="text-gray-700 mb-4">Dibuat Ala Traditional - Rasa otentik warisan Indonesia</p>
                
                <div class="flex flex-wrap gap-2 mb-6">
                    <div class="bg-gray-100 px-3 py-1 rounded-lg">
                        <div class="text-sm font-bold text-gray-800">NETTO 270ml</div>
                    </div>
                    <div class="bg-red-50 px-3 py-1 rounded-lg border border-red-200">
                        <div class="text-sm font-bold abc-red">Asli & Tradisional</div>
                    </div>
                </div>
                
                <button 
                    onclick="selectProduct('sambal', 'ABC Sambal Asli', this)"
                    class="btn-primary w-full text-center product-select-btn"
                    data-product="sambal"
                >
                    <i class="fas fa-pepper-hot mr-2"></i> Pilih Sambal Asli
                </button>
            </div>
        </div>
        
        <!-- Product 2 - Kecap Manis -->
        <div class="product-card bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
            <div class="p-1">
                <img 
                    src="{{ asset('images/Product2.png') }}" 
                    alt="ABC Kecap Manis"
                    class="w-full h-auto max-w-full object-contain"
                >
            </div>
            
            <div class="p-6">
                <h3 class="text-2xl font-bold abc-red mb-3">ABC KECAP MANIS</h3>
                <p class="text-gray-700 mb-4">2X Fermentasi - Rasa lebih Gurih dan Kental</p>
                
                <div class="flex flex-wrap gap-2 mb-6">
                    <div class="bg-gray-100 px-3 py-1 rounded-lg">
                        <div class="text-sm font-bold text-gray-800">BERAT BERSIH 685g</div>
                    </div>
                    <div class="bg-green-100 px-3 py-1 rounded-lg">
                        <div class="text-sm font-bold text-green-800">HALAL</div>
                    </div>
                    <div class="bg-yellow-50 px-3 py-1 rounded-lg border border-yellow-200">
                        <div class="text-sm font-bold text-yellow-800">2X Fermentasi</div>
                    </div>
                </div>
                
                <button 
                    onclick="selectProduct('kecap', 'ABC Kecap Manis', this)"
                    class="btn-primary w-full text-center product-select-btn"
                    data-product="kecap"
                >
                    <i class="fas fa-wine-bottle mr-2"></i> Pilih Kecap Manis
                </button>
            </div>
        </div>
    </div>
    
    <!-- Brand Slogan -->
    <div class="text-center my-12 py-8 border-y border-gray-200">
        <h2 class="text-3xl font-bold abc-red mb-2">ABC</h2>
        <p class="text-2xl font-bold text-gray-800">Ahlinya Buat Citarasa</p>
    </div>
    
    <!-- Selected Product Indicator -->
    <div id="selectedProductIndicator" class="fixed bottom-0 left-0 right-0 bg-white border-t-2 border-abc-red shadow-2xl p-4 hidden z-50 transform translate-y-full transition-transform duration-300">
        <div class="max-w-4xl mx-auto">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex-1">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-shopping-bag text-abc-red text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Produk yang dipilih:</p>
                            <h3 id="selectedProductName" class="text-xl font-bold abc-red"></h3>
                        </div>
                    </div>
                </div>
                
                <div class="flex gap-3">
                    <button 
                        onclick="clearSelection()" 
                        class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50 transition-colors"
                    >
                        <i class="fas fa-edit mr-2"></i> Ubah
                    </button>
                    
                    <form id="productForm" action="{{ route('select-product') }}" method="POST" class="m-0">
                        @csrf
                        <input type="hidden" id="product_type" name="product_type" value="">
                        <input type="hidden" id="product_name" name="product_name" value="">
                        
                        <button 
                            type="submit" 
                            id="continueButton"
                            class="btn-primary px-8 py-3 rounded-xl shadow-lg"
                        >
                            <i class="fas fa-arrow-right mr-2"></i> Lanjut ke Form
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Back to Home -->
    <div class="text-center mt-12 mb-24 md:mb-12">
        <a href="{{ route('homepage') }}" class="text-abc-red hover:underline font-medium inline-flex items-center group">
            <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i> Kembali ke Halaman Utama
        </a>
    </div>
</div>

<!-- JavaScript untuk menangani seleksi produk -->
<script>
    let selectedProduct = null;
    let selectedProductName = null;
    let selectedButton = null;
    
    // Fungsi untuk memilih produk
    function selectProduct(productType, productName, buttonElement) {
        // Reset seleksi sebelumnya
        if (selectedButton) {
            resetButton(selectedButton);
        }
        
        // Set produk baru
        selectedProduct = productType;
        selectedProductName = productName;
        selectedButton = buttonElement;
        
        // Update button state
        buttonElement.classList.remove('bg-gradient-to-r', 'from-red-600', 'to-red-800');
        buttonElement.classList.add('bg-gradient-to-r', 'from-green-600', 'to-green-700');
        buttonElement.innerHTML = '<i class="fas fa-check-circle mr-2"></i> Terpilih';
        
        // Update hidden form inputs
        document.getElementById('product_type').value = productType;
        document.getElementById('product_name').value = productName;
        
        // Update tampilan produk terpilih
        document.getElementById('selectedProductName').textContent = productName;
        
        // Tampilkan dan animasikan indikator
        const indicator = document.getElementById('selectedProductIndicator');
        indicator.classList.remove('hidden');
        setTimeout(() => {
            indicator.classList.remove('translate-y-full');
            indicator.classList.add('translate-y-0');
        }, 10);
        
        // Scroll ke indikator jika di mobile
        if (window.innerWidth < 768) {
            setTimeout(() => {
                indicator.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }, 350);
        }
        
        // Tambahkan efek visual pada card produk
        const productCard = buttonElement.closest('.product-card');
        productCard.classList.add('ring-2', 'ring-abc-red', 'ring-offset-2');
    }
    
    // Fungsi untuk reset button state
    function resetButton(button) {
        button.classList.remove('bg-gradient-to-r', 'from-green-600', 'to-green-700');
        button.classList.add('bg-gradient-to-r', 'from-red-600', 'to-red-800');
        
        const productType = button.getAttribute('data-product');
        if (productType === 'sambal') {
            button.innerHTML = '<i class="fas fa-pepper-hot mr-2"></i> Pilih Sambal Asli';
        } else {
            button.innerHTML = '<i class="fas fa-wine-bottle mr-2"></i> Pilih Kecap Manis';
        }
        
        // Hapus efek visual dari card
        const productCard = button.closest('.product-card');
        productCard.classList.remove('ring-2', 'ring-abc-red', 'ring-offset-2');
    }
    
    // Fungsi untuk menghapus seleksi
    function clearSelection() {
        if (selectedButton) {
            resetButton(selectedButton);
        }
        
        selectedProduct = null;
        selectedProductName = null;
        selectedButton = null;
        
        // Sembunyikan indikator dengan animasi
        const indicator = document.getElementById('selectedProductIndicator');
        indicator.classList.add('translate-y-full');
        indicator.classList.remove('translate-y-0');
        
        setTimeout(() => {
            indicator.classList.add('hidden');
        }, 300);
        
        // Reset form
        document.getElementById('product_type').value = '';
        document.getElementById('product_name').value = '';
    }
    
    // Validasi form sebelum submit
    document.getElementById('productForm').addEventListener('submit', function(e) {
        if (!selectedProduct) {
            e.preventDefault();
            
            // Animasi shake pada tombol
            const buttons = document.querySelectorAll('.product-select-btn');
            buttons.forEach(btn => {
                btn.classList.add('animate-shake');
                setTimeout(() => {
                    btn.classList.remove('animate-shake');
                }, 500);
            });
            
            // Tampilkan alert
            const alertDiv = document.createElement('div');
            alertDiv.className = 'fixed top-4 left-1/2 transform -translate-x-1/2 bg-red-100 border border-red-400 text-red-700 px-6 py-3 rounded-xl shadow-lg z-50 animate-fadeIn';
            alertDiv.innerHTML = '<i class="fas fa-exclamation-circle mr-2"></i> Silakan pilih produk terlebih dahulu!';
            document.body.appendChild(alertDiv);
            
            setTimeout(() => {
                alertDiv.classList.add('opacity-0', 'transition-opacity', 'duration-300');
                setTimeout(() => alertDiv.remove(), 300);
            }, 3000);
            
            return false;
        }
        
        // Tambahkan efek loading pada tombol submit
        const submitBtn = document.getElementById('continueButton');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';
        submitBtn.disabled = true;
        
        // Reset setelah 3 detik (fallback)
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 3000);
        
        return true;
    });
    
    // Inisialisasi saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Check session untuk error messages
        @if(session('error'))
            showAlert('{{ session('error') }}', 'error');
        @endif
        
        // Tambahkan efek hover pada product cards
        const productCards = document.querySelectorAll('.product-card');
        productCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                if (!this.classList.contains('ring-abc-red')) {
                    this.classList.add('scale-[1.02]');
                }
            });
            
            card.addEventListener('mouseleave', function() {
                this.classList.remove('scale-[1.02]');
            });
        });
        
        // Handle klik di luar indicator untuk close (opsional)
        document.addEventListener('click', function(e) {
            const indicator = document.getElementById('selectedProductIndicator');
            if (!indicator.classList.contains('hidden') && 
                !indicator.contains(e.target) && 
                !e.target.closest('.product-select-btn')) {
                // Optional: auto-close when clicking outside
                // clearSelection();
            }
        });
    });
    
    // Fungsi untuk menampilkan alert
    function showAlert(message, type = 'info') {
        const alertDiv = document.createElement('div');
        alertDiv.className = `fixed top-4 left-1/2 transform -translate-x-1/2 px-6 py-3 rounded-xl shadow-lg z-50 animate-fadeIn ${
            type === 'error' ? 'bg-red-100 border-red-400 text-red-700' :
            type === 'success' ? 'bg-green-100 border-green-400 text-green-700' :
            'bg-blue-100 border-blue-400 text-blue-700'
        }`;
        alertDiv.innerHTML = `<i class="fas fa-${type === 'error' ? 'exclamation-circle' : type === 'success' ? 'check-circle' : 'info-circle'} mr-2"></i> ${message}`;
        
        document.body.appendChild(alertDiv);
        
        setTimeout(() => {
            alertDiv.classList.add('opacity-0', 'transition-opacity', 'duration-300');
            setTimeout(() => alertDiv.remove(), 300);
        }, 3000);
    }
</script>

<style>
    /* Custom styles untuk halaman promo */
    .section-title {
        font-family: 'Montserrat', sans-serif;
        font-weight: 800;
        color: #222;
        position: relative;
        display: inline-block;
        padding-bottom: 10px;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(to right, #d32f2f, #b71c1c);
        border-radius: 2px;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #d32f2f 0%, #b71c1c 100%);
        color: white;
        padding: 16px 24px;
        border-radius: 12px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-block;
        text-align: center;
        box-shadow: 0 6px 16px rgba(211, 47, 47, 0.3);
        position: relative;
        overflow: hidden;
        font-size: 1rem;
    }
    
    .btn-primary:hover:not(.bg-gradient-to-r.from-green-600) {
        background: linear-gradient(135deg, #b71c1c 0%, #9a0007 100%);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(211, 47, 47, 0.4);
    }
    
    .btn-primary:active {
        transform: translateY(-1px);
    }
    
    /* Animasi untuk shake */
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        20%, 40%, 60%, 80% { transform: translateX(5px); }
    }
    
    .animate-shake {
        animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
    }
    
    /* Animasi fade in */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translate(-50%, -20px);
        }
        to {
            opacity: 1;
            transform: translate(-50%, 0);
        }
    }
    
    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out;
    }
    
    /* Responsive design untuk gambar */
    @media (max-width: 768px) {
        .grid-cols-2 {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .product-card {
            max-width: 100%;
            margin: 0 auto;
        }
        
        .btn-primary {
            padding: 14px 20px;
            font-size: 0.95rem;
        }
        
        #selectedProductIndicator .flex {
            flex-direction: column;
            gap: 12px;
        }
        
        #selectedProductIndicator button {
            width: 100%;
        }
        
        .text-3xl {
            font-size: 1.875rem;
        }
        
        .text-2xl {
            font-size: 1.5rem;
        }
    }
    
    /* Efek hover untuk semua card */
    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    }
    
    .product-card:hover {
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
    
    /* Efek untuk gambar produk */
    .object-contain {
        object-fit: contain;
        max-height: 280px;
    }
    
    /* Efek untuk gambar Head */
    .object-cover {
        object-fit: cover;
        height: 200px;
    }
    
    @media (max-width: 480px) {
        .object-cover {
            height: 150px;
        }
        
        .object-contain {
            max-height: 220px;
        }
        
        .p-6 {
            padding: 1.25rem;
        }
        
        .text-2xl {
            font-size: 1.25rem;
        }
    }
</style>
@endsection
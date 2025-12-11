@extends('layouts.app')

@section('title', 'Form Data Diri - PromoMurahABC')

@section('content')
<div class="min-h-screen-safe py-4 sm:py-6 md:py-8">
    <div class="container-responsive">
        <!-- Header Section dengan Head3.png -->
        <div class="text-center mb-6 sm:mb-8 md:mb-10">
            <div class="card-responsive overflow-hidden mb-4 sm:mb-6">
                <img 
                    src="{{ asset('images/Head3.png') }}" 
                    alt="ABC Ahlinya Buat Citarasa"
                    class="img-responsive"
                    loading="lazy"
                >
            </div>
        
        <!-- Progress Indicator -->
        <div class="mb-8 sm:mb-10 md:mb-12 px-2">
            <div class="flex items-center justify-between max-w-sm mx-auto">
                <!-- Step 1 -->
                <div class="flex flex-col items-center flex-1">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-abc-red text-white flex items-center justify-center mb-1 sm:mb-2">
                        <i class="fas fa-check text-xs sm:text-sm"></i>
                    </div>
                    <div class="text-responsive-small font-medium text-center">Pilih Produk</div>
                </div>
                
                <!-- Line -->
                <div class="flex-1 h-1 bg-abc-red mx-1 sm:mx-2"></div>
                
                <!-- Step 2 -->
                <div class="flex flex-col items-center flex-1">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-abc-red text-white flex items-center justify-center mb-1 sm:mb-2">
                        <span class="text-xs sm:text-sm font-bold">2</span>
                    </div>
                    <div class="text-responsive-small font-medium text-center">Isi Form</div>
                </div>
                
                <!-- Line -->
                <div class="flex-1 h-1 bg-gray-300 mx-1 sm:mx-2"></div>
                
                <!-- Step 3 -->
                <div class="flex flex-col items-center flex-1">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center mb-1 sm:mb-2">
                        <span class="text-xs sm:text-sm font-bold">3</span>
                    </div>
                    <div class="text-responsive-small font-medium text-gray-500 text-center">Selesai</div>
                </div>
            </div>
        </div>
        
        <!-- Selected Product Info -->
        <div class="card-responsive mb-6 sm:mb-8">
            <div class="p-4 sm:p-5 md:p-6">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 sm:gap-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-blue-100 flex items-center justify-center mr-3 sm:mr-4">
                            <i class="fas fa-shopping-bag text-blue-500 text-lg sm:text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-responsive-small font-bold text-blue-800">Produk yang Anda Pilih</h3>
                            <p class="text-responsive-h3 font-bold abc-red mt-0.5">{{ $selectedProduct['name'] }}</p>
                        </div>
                    </div>
                    <a href="{{ route('promo') }}" class="btn-responsive border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 ml-auto mt-3 sm:mt-0">
                        <i class="fas fa-edit mr-2"></i>
                        <span class="text-responsive-small">Ubah Produk</span>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Form Section -->
        <div class="card-responsive p-4 sm:p-6 md:p-8">
            <h2 class="section-title text-responsive-h3 mb-4 sm:mb-6">Isi Data Diri Anda</h2>
            
            <form id="voucherForm" action="{{ route('submit-voucher') }}" method="POST" onsubmit="return validateForm()">
                @csrf
                
                <!-- Syarat & Ketentuan -->
                <div class="mb-6 sm:mb-8 bg-gray-50 p-4 sm:p-5 md:p-6 rounded-xl">
                    <div class="flex items-center justify-between cursor-pointer touch-target" onclick="toggleAccordion()">
                        <h3 class="text-responsive-body font-bold text-gray-800">Syarat & Ketentuan Lengkap</h3>
                        <i class="fas fa-chevron-down text-gray-600"></i>
                    </div>
                    
                    <div id="syaratAccordion" class="mt-3 sm:mt-4 text-gray-600 space-y-2 text-responsive-small hidden">
                        <p>1. Voucher hanya berlaku untuk pembelian produk ABC Kecap Manis dan ABC Sambal Asli di gerai Alfamart.</p>
                        <p>2. Voucher senilai Rp 5.000 dengan minimum pembelian Rp 25.000.</p>
                        <p>3. Periode promo berlaku hingga 16 Februari 2026.</p>
                        <p>4. Voucher tidak dapat digabungkan dengan promo lainnya.</p>
                        <p>5. Satu voucher hanya dapat digunakan untuk satu kali transaksi.</p>
                        <p>6. Voucher tidak dapat ditukarkan dengan uang tunai.</p>
                        <p>7. Promo hanya berlaku di gerai Alfamart terdekat yang berpartisipasi.</p>
                        <p>8. Voucher hanya berlaku untuk 1 (satu) kali penggunaan per transaksi.</p>
                        <p>9. Tidak berlaku untuk pembelian produk ABC dengan harga promosi lainnya.</p>
                        <p>10. Keputusan Alfamart bersifat mutlak dan tidak dapat diganggu gugat.</p>
                    </div>
                    
                    <div class="mt-4 sm:mt-6 flex items-start touch-target">
                        <input type="checkbox" id="syaratCheckbox" name="syarat" class="w-5 h-5 mt-0.5 mr-3 flex-shrink-0">
                        <label for="syaratCheckbox" class="text-responsive-small text-gray-700">
                            <span class="font-medium">Saya telah membaca dan menyetujui</span> Syarat & Ketentuan di atas
                        </label>
                    </div>
                </div>
                
                <!-- Form Input -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                    <!-- Nama Lengkap -->
                    <div class="form-group">
                        <label for="nama_lengkap" class="block text-gray-700 font-medium mb-2 text-responsive-small">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" required 
                               class="w-full px-4 py-3 sm:py-3.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-responsive-body"
                               placeholder="Masukkan nama lengkap"
                               autocomplete="name">
                        <div class="text-xxs sm:text-xs text-gray-500 mt-1">Sesuai dengan KTP</div>
                    </div>
                    
                    <!-- Nomor Telepon -->
                    <div class="form-group">
                        <label for="nomor_telepon" class="block text-gray-700 font-medium mb-2 text-responsive-small">
                            Nomor Telepon <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="nomor_telepon" name="nomor_telepon" required 
                               class="w-full px-4 py-3 sm:py-3.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-responsive-body"
                               placeholder="08xxxxxxxxxx"
                               inputmode="numeric"
                               autocomplete="tel">
                        <div class="text-xxs sm:text-xs text-gray-500 mt-1">Format: 08xxxxxxxxxx</div>
                    </div>
                    
                    <!-- Email -->
                    <div class="sm:col-span-2 form-group">
                        <label for="email" class="block text-gray-700 font-medium mb-2 text-responsive-small">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" required 
                               class="w-full px-4 py-3 sm:py-3.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-responsive-body"
                               placeholder="nama@email.com"
                               inputmode="email"
                               autocomplete="email">
                        <div class="text-xxs sm:text-xs text-gray-500 mt-1">Voucher akan dikirim ke email ini</div>
                    </div>
                </div>
                
                <!-- Additional Info -->
                <div class="mt-6 sm:mt-8 bg-yellow-50 border border-yellow-200 rounded-xl p-4 sm:p-5">
                    <h3 class="font-bold text-yellow-800 mb-2 text-responsive-body">
                        <i class="fas fa-info-circle mr-2"></i>Informasi Penting
                    </h3>
                    <ul class="text-yellow-700 space-y-2 text-responsive-small">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mt-0.5 mr-2 text-green-500"></i>
                            <span>Pastikan data yang diisi benar dan valid</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mt-0.5 mr-2 text-green-500"></i>
                            <span>Voucher akan dikirim ke email dalam waktu 1x24 jam</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mt-0.5 mr-2 text-green-500"></i>
                            <span>Periksa folder spam jika voucher tidak ditemukan di inbox</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Submit Buttons -->
                <div class="mt-6 sm:mt-8 flex flex-col sm:flex-row gap-3 sm:gap-4">
                    <button type="submit" class="btn-responsive btn-primary flex-1 order-2 sm:order-1">
                        <i class="fas fa-gift mr-2"></i>
                        <span class="text-responsive-body font-semibold">Dapatkan Voucher</span>
                    </button>
                    
                    <a href="{{ route('promo') }}" class="btn-responsive border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 order-1 sm:order-2">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span class="text-responsive-body">Kembali ke Pilih Produk</span>
                    </a>
                </div>
                
                <!-- Privacy Policy -->
                <div class="text-center mt-4 sm:mt-6 text-responsive-small text-gray-500">
                    <p>Dengan mengisi form ini, Anda menyetujui <a href="#" class="text-abc-red hover:underline">Kebijakan Privasi</a> kami</p>
                </div>
            </form>
        </div>
        
        <!-- Contact Info -->
        <div class="text-center mt-8 sm:mt-12 pt-6 sm:pt-8 border-t border-gray-200">
            <p class="text-responsive-body text-gray-600">Butuh bantuan? Hubungi kami:</p>
            <p class="text-responsive-body font-medium abc-red mt-2">
                <i class="fas fa-phone-alt mr-2"></i> 1500-123
            </p>
            <p class="text-responsive-small text-gray-500 mt-4">© 2024 PromoMurahABC. Semua hak dilindungi.</p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Fungsi untuk toggle accordion syarat & ketentuan
    function toggleAccordion() {
        const accordion = document.getElementById('syaratAccordion');
        const icon = document.querySelector('#syaratAccordion').previousElementSibling.querySelector('i');
        
        accordion.classList.toggle('hidden');
        accordion.classList.toggle('animate-fadeInUp');
        
        icon.classList.toggle('fa-chevron-down');
        icon.classList.toggle('fa-chevron-up');
    }
    
    // Fungsi untuk validasi form sebelum submit
    function validateForm() {
        const checkbox = document.getElementById('syaratCheckbox');
        
        // Validasi syarat & ketentuan
        if (!checkbox.checked) {
            if (responsiveUtils) {
                responsiveUtils.showToast('Harap centang persetujuan Syarat & Ketentuan', 'error');
            } else {
                alert('Harap centang persetujuan Syarat & Ketentuan');
            }
            checkbox.focus();
            
            // Add shake animation to checkbox
            checkbox.parentElement.classList.add('animate-shake');
            setTimeout(() => checkbox.parentElement.classList.remove('animate-shake'), 500);
            
            return false;
        }
        
        // Validasi email format
        const email = document.getElementById('email').value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            if (responsiveUtils) {
                responsiveUtils.showToast('Format email tidak valid', 'error');
            } else {
                alert('Format email tidak valid');
            }
            document.getElementById('email').focus();
            return false;
        }
        
        // Validasi nomor telepon
        const telepon = document.getElementById('nomor_telepon').value;
        const teleponRegex = /^[0-9]{10,13}$/;
        if (!teleponRegex.test(telepon)) {
            if (responsiveUtils) {
                responsiveUtils.showToast('Format nomor telepon tidak valid. Harap masukkan 10-13 digit angka', 'error');
            } else {
                alert('Format nomor telepon tidak valid. Harap masukkan 10-13 digit angka');
            }
            document.getElementById('nomor_telepon').focus();
            return false;
        }
        
        // Show loading state
        if (responsiveUtils) {
            responsiveUtils.showLoading();
            
            // Change button text on mobile
            if (window.innerWidth < 768) {
                const submitBtn = document.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';
                submitBtn.disabled = true;
                
                // Reset after 3 seconds (fallback)
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 3000);
            }
        }
        
        return true;
    }
    
    // Initialize on DOM loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Sembunyikan accordion saat pertama kali load
        document.getElementById('syaratAccordion').classList.add('hidden');
        
        // Auto-focus ke input pertama pada desktop
        if (window.innerWidth >= 768) {
            setTimeout(() => {
                document.getElementById('nama_lengkap').focus();
            }, 300);
        }
        
        // Tambahkan efek animasi untuk Head3 image
        const head3Image = document.querySelector('img[alt*="Ahlinya Buat Citarasa"]');
        if (head3Image) {
            head3Image.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                head3Image.classList.add('transition-all', 'duration-500');
                head3Image.classList.remove('opacity-0', 'scale-95');
                head3Image.classList.add('opacity-100', 'scale-100');
            }, 100);
        }
        
        // Handle input focus for mobile
        const inputs = document.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                // Scroll to input on mobile when focused
                if (window.innerWidth < 768) {
                    setTimeout(() => {
                        this.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }, 300);
                }
            });
        });
        
        // Handle keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && e.target.type !== 'textarea') {
                // Don't submit on enter in text inputs
                if (e.target.type === 'text' || e.target.type === 'tel' || e.target.type === 'email') {
                    const form = e.target.form;
                    const index = Array.prototype.indexOf.call(form, e.target);
                    const nextElement = form.elements[index + 1];
                    
                    if (nextElement) {
                        nextElement.focus();
                        e.preventDefault();
                    }
                }
            }
        });
    });
    
    // Handle form submission with loading
    const form = document.getElementById('voucherForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            // Already handled in validateForm
            return true;
        });
    }
</script>

<style>
    /* Custom styles untuk form page */
    .form-group {
        margin-bottom: 1rem;
    }
    
    @media (max-width: 640px) {
        .form-group {
            margin-bottom: 1.25rem;
        }
    }
    
    /* Style untuk input focus pada mobile */
    @media (max-width: 768px) {
        input:focus, 
        textarea:focus, 
        select:focus {
            font-size: 16px !important; /* Prevent iOS zoom */
        }
    }
    
    /* Style untuk progress indicator pada mobile */
    @media (max-width: 640px) {
        .progress-line {
            margin: 0 0.5rem;
        }
        
        .progress-step {
            min-width: 60px;
        }
    }
    
    /* Style untuk accordion */
    #syaratAccordion p {
        line-height: 1.5;
    }
    
    /* Style untuk checkbox pada mobile */
    @media (max-width: 640px) {
        #syaratCheckbox {
            width: 1.25rem;
            height: 1.25rem;
        }
    }
    
    /* Animation for shake */
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        20%, 40%, 60%, 80% { transform: translateX(5px); }
    }
    
    .animate-shake {
        animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
    }
    
    /* Responsive spacing untuk form */
    @media (max-width: 375px) {
        .min-h-screen-safe {
            padding-top: 1rem;
            padding-bottom: 5rem; /* Space for bottom nav */
        }
        
        .card-responsive {
            border-radius: 12px;
        }
        
        .btn-responsive {
            padding: 0.75rem 1rem;
            min-height: 44px;
        }
    }
    
    /* Tablet optimization */
    @media (min-width: 641px) and (max-width: 1023px) {
        .container-responsive {
            max-width: 90%;
        }
        
        .grid-cols-2 {
            gap: 1.5rem;
        }
    }
    
    /* Desktop optimization */
    @media (min-width: 1024px) {
        .form-group {
            margin-bottom: 1.5rem;
        }
    }
    
    /* High contrast for accessibility */
    @media (prefers-contrast: high) {
        .btn-primary {
            border: 2px solid #000;
        }
        
        input, textarea, select {
            border: 2px solid #000;
        }
    }
    
    /* Reduced motion preferences */
    @media (prefers-reduced-motion: reduce) {
        * {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }
</style>
@endpush
@endsection
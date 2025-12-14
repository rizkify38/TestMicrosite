@extends('layouts.app')

@section('title', 'Form Data Diri - PromoMurahABC')

@section('content')
<div class="min-h-screen py-6 sm:py-10 px-4">
    <div class="container-custom max-w-3xl">
        <!-- Header Image -->
        <div class="text-center mb-6 sm:mb-10 animate-fade-in-up">
            <div class="card-modern inline-block w-full max-w-2xl">
                <img 
                    src="{{ asset('images/Head3.png') }}" 
                    alt="ABC Ahlinya Buat Citarasa"
                    class="w-full h-auto"
                >
            </div>
        </div>
        
        <!-- Progress Steps -->
        <div class="mb-8 sm:mb-12 animate-fade-in-up" style="animation-delay: 0.1s">
            <div class="flex items-center justify-between max-w-md mx-auto">
                <!-- Step 1 -->
                <div class="flex flex-col items-center flex-1">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-gradient-abc text-white flex items-center justify-center mb-2 shadow-lg">
                        <i class="fas fa-check text-sm sm:text-base"></i>
                    </div>
                    <div class="text-xs sm:text-sm font-semibold text-center">Pilih Produk</div>
                </div>
                
                <!-- Line -->
                <div class="flex-1 h-1 bg-gradient-abc mx-2"></div>
                
                <!-- Step 2 -->
                <div class="flex flex-col items-center flex-1">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-gradient-abc text-white flex items-center justify-center mb-2 shadow-lg animate-pulse">
                        <span class="text-sm sm:text-base font-bold">2</span>
                    </div>
                    <div class="text-xs sm:text-sm font-semibold text-center abc-red">Isi Form</div>
                </div>
                
                <!-- Line -->
                <div class="flex-1 h-1 bg-gray-300 mx-2"></div>
                
                <!-- Step 3 -->
                <div class="flex flex-col items-center flex-1">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center mb-2">
                        <span class="text-sm sm:text-base font-bold">3</span>
                    </div>
                    <div class="text-xs sm:text-sm font-medium text-gray-500 text-center">Selesai</div>
                </div>
            </div>
        </div>
        
        <!-- Selected Product Info with Image -->
        @if(session('selected_product'))
        <div class="card-modern p-4 sm:p-6 mb-6 sm:mb-8 bg-gradient-to-r from-red-50 to-orange-50 border-2 border-red-200 animate-fade-in-up" style="animation-delay: 0.2s">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-white rounded-xl flex items-center justify-center flex-shrink-0 shadow-md p-2">
                    @if(session('selected_product')['type'] === 'sambal')
                        <img src="{{ asset('images/Product1.png') }}" alt="ABC Sambal Asli" class="w-full h-full object-contain">
                    @else
                        <img src="{{ asset('images/Product2.png') }}" alt="ABC Kecap Manis" class="w-full h-full object-contain">
                    @endif
                </div>
                <div class="flex-1">
                    <p class="text-xs sm:text-sm text-gray-600 mb-1">Produk yang dipilih:</p>
                    <h3 class="text-base sm:text-lg font-bold abc-red">{{ session('selected_product')['name'] }}</h3>
                </div>
            </div>
        </div>
        @endif
        
        <!-- Form Card -->
        <div class="card-modern p-6 sm:p-8 lg:p-10 animate-fade-in-up" style="animation-delay: 0.3s">
            <h2 class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-gray-900 mb-2 text-center">
                Isi Data Diri Anda
            </h2>
            <p class="text-sm sm:text-base text-gray-600 mb-6 sm:mb-8 text-center">
                Lengkapi form di bawah untuk mendapatkan voucher Anda
            </p>
            
            <!-- Error Messages -->
            @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-circle text-red-500 text-xl mr-3 mt-0.5"></i>
                    <div class="flex-1">
                        <h3 class="font-bold text-red-800 mb-2">Terjadi Kesalahan:</h3>
                        <ul class="list-disc list-inside space-y-1 text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif
            
            <form action="{{ route('submit-voucher') }}" method="POST" class="space-y-5 sm:space-y-6">
                @csrf
                
                <!-- Nama Lengkap -->
                <div>
                    <label for="nama_lengkap" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user mr-2 abc-red"></i> Nama Lengkap
                    </label>
                    <input 
                        type="text" 
                        id="nama_lengkap" 
                        name="nama_lengkap" 
                        value="{{ old('nama_lengkap') }}"
                        class="input-modern"
                        placeholder="Masukkan nama lengkap Anda"
                        required
                    >
                </div>
                
                <!-- Nomor Telepon -->
                <div>
                    <label for="nomor_telepon" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-phone mr-2 abc-red"></i> Nomor Telepon
                    </label>
                    <input 
                        type="tel" 
                        id="nomor_telepon" 
                        name="nomor_telepon" 
                        value="{{ old('nomor_telepon') }}"
                        class="input-modern"
                        placeholder="08xxxxxxxxxx"
                        pattern="[0-9]{10,15}"
                        required
                    >
                    <p class="text-xs text-gray-500 mt-1.5">Format: 08xxxxxxxxxx (10-15 digit)</p>
                </div>
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2 abc-red"></i> Email
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        class="input-modern"
                        placeholder="nama@email.com"
                        required
                    >
                    <p class="text-xs text-gray-500 mt-1.5">Satu email hanya bisa mendapatkan satu voucher</p>
                </div>
                
                <!-- Syarat & Ketentuan -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 sm:p-5">
                    <div class="flex items-start">
                        <input 
                            type="checkbox" 
                            id="syarat" 
                            name="syarat" 
                            class="mt-1 w-5 h-5 text-red-600 border-gray-300 rounded focus:ring-red-500 cursor-pointer"
                            required
                        >
                        <label for="syarat" class="ml-3 text-sm text-gray-700 cursor-pointer">
                            Saya menyetujui <button type="button" onclick="toggleTerms()" class="font-bold abc-red hover:underline">Syarat & Ketentuan</button> yang berlaku
                        </label>
                    </div>
                    
                    <div id="termsContent" class="hidden mt-4 pt-4 border-t border-blue-200">
                        <h4 class="font-bold text-blue-900 mb-3">Syarat & Ketentuan:</h4>
                        <ol class="space-y-2 text-xs sm:text-sm text-blue-800 list-decimal list-inside">
                            <li class="flex items-start">
                                <span class="font-semibold mr-2">1.</span>
                                <span>Voucher tidak dapat diperjualbelikan atau dipindahtangankan.</span>
                            </li>
                            <li class="flex items-start">
                                <span class="font-semibold mr-2">2.</span>
                                <span>Voucher dapat digunakan di seluruh gerai Alfamart di Indonesia.</span>
                            </li>
                            <li class="flex items-start">
                                <span class="font-semibold mr-2">3.</span>
                                <span>Voucher berlaku selama 1 x 24 jam sejak diterbitkan.</span>
                            </li>
                            <li class="flex items-start">
                                <span class="font-semibold mr-2">4.</span>
                                <span>Silakan lakukan screenshot kode voucher setelah proses registrasi berhasil.</span>
                            </li>
                            <li class="flex items-start">
                                <span class="font-semibold mr-2">5.</span>
                                <span>Kode voucher akan dikirim secara otomatis ke alamat email yang terdaftar.</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="pt-4">
                    <button 
                        type="submit" 
                        class="btn-primary w-full text-base sm:text-lg py-4 sm:py-5 rounded-xl font-extrabold"
                    >
                        <i class="fas fa-gift mr-2"></i> Dapatkan Voucher Sekarang
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Back Button -->
        <div class="text-center mt-6 animate-fade-in-up" style="animation-delay: 0.4s">
            <a href="{{ route('promo') }}" class="inline-flex items-center text-sm sm:text-base text-gray-600 hover:text-gray-900 font-medium">
                <i class="fas fa-arrow-left mr-2"></i> Kembali Pilih Produk
            </a>
        </div>
    </div>
</div>

<script>
function toggleTerms() {
    const content = document.getElementById('termsContent');
    content.classList.toggle('hidden');
}

// Auto-format phone number
document.getElementById('nomor_telepon').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    e.target.value = value;
});
</script>
@endsection
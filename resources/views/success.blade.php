@extends('layouts.app')

@section('title', 'Voucher Berhasil - PromoMurahABC')

@section('content')
<div class="max-w-4xl mx-auto text-center">
    <!-- Success Icon -->
    <div class="mb-8">
        <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto">
            <i class="fas fa-check-circle text-green-500 text-5xl"></i>
        </div>
    </div>
    
    <!-- Success Message -->
    <h1 class="text-4xl font-bold text-green-600 mb-4">Selamat!</h1>
    <p class="text-xl text-gray-700 mb-8">Anda mendapatkan potongan voucher sebesar <span class="font-bold abc-red">Rp 5.000</span></p>
    
    <!-- Product Info -->
    @if(isset($data['product']))
    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-6 max-w-md mx-auto">
        <div class="flex items-center">
            <i class="fas fa-shopping-bag text-yellow-600 text-xl mr-3"></i>
            <div class="text-left">
                <p class="font-medium text-yellow-800">Voucher berlaku untuk:</p>
                <p class="text-lg font-bold abc-red">{{ $data['product'] }}</p>
            </div>
        </div>
    </div>
    @endif
    
    <!-- Voucher Card -->
    <div class="bg-gradient-to-r from-red-50 to-orange-50 border-2 border-dashed border-red-300 rounded-2xl p-8 mb-10 max-w-md mx-auto">
        <div class="text-sm text-gray-500 mb-2">Kode Voucher</div>
        <div class="text-4xl font-bold abc-red mb-4">{{ $data['voucher_code'] }}</div>
        
        <!-- Barcode -->
        <div class="my-8">
            <div class="barcode text-center">*{{ $data['voucher_code'] }}*</div>
            <div class="text-xs text-gray-500 mt-2">Scan barcode di kasir Alfamart</div>
        </div>
        
        <div class="text-lg font-semibold abc-red mb-2">Rp 5.000</div>
        <div class="text-gray-600 mb-4">Potongan belanja produk ABC</div>
        
        <div class="text-sm text-gray-500">
            <p>Berlaku hingga: {{ $data['expired_date'] }}</p>
            <p class="mt-2">Hanya di Alfamart terdekat</p>
        </div>
    </div>
    
    <!-- User Info -->
    <div class="bg-white rounded-xl shadow p-6 mb-10 max-w-md mx-auto">
        <h3 class="text-lg font-bold mb-4 text-left">Detail Penerima Voucher</h3>
        
        <div class="space-y-3 text-left">
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-600">Nama Lengkap:</span>
                <span class="font-medium">{{ $data['nama'] }}</span>
            </div>
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-600">Nomor Telepon:</span>
                <span class="font-medium">{{ $data['telepon'] }}</span>
            </div>
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-600">Email:</span>
                <span class="font-medium">{{ $data['email'] }}</span>
            </div>
            @if(isset($data['product']))
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-600">Produk Dipilih:</span>
                <span class="font-medium">{{ $data['product'] }}</span>
            </div>
            @endif
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-600">Tanggal Diterima:</span>
                <span class="font-medium">{{ date('d F Y') }}</span>
            </div>
        </div>
    </div>
    
    <!-- Instructions -->
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-10 text-left max-w-2xl mx-auto">
        <h3 class="text-lg font-bold mb-4 text-blue-800">Cara Menggunakan Voucher:</h3>
        <ol class="list-decimal pl-5 space-y-2 text-blue-700">
            <li>Tunjukkan kode voucher atau barcode ini ke kasir Alfamart</li>
            @if(isset($data['product']))
            <li>Voucher berlaku untuk pembelian <span class="font-bold">{{ $data['product'] }}</span></li>
            @else
            <li>Voucher dapat digunakan untuk pembelian produk ABC Kecap Manis atau ABC Sambal Asli</li>
            @endif
            <li>Voucher berlaku dengan minimum pembelian Rp 25.000</li>
            <li>Voucher tidak dapat digabungkan dengan promo lainnya</li>
            <li>Pastikan untuk menggunakan voucher sebelum {{ $data['expired_date'] }}</li>
        </ol>
    </div>
    
    <!-- Action Buttons -->
    <div class="space-y-4 max-w-md mx-auto">
        <a href="{{ route('promo') }}" class="btn-primary block">
            Dapatkan Voucher Lainnya <i class="fas fa-redo ml-2"></i>
        </a>
        
        <a href="{{ route('homepage') }}" class="block py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50">
            <i class="fas fa-home mr-2"></i> Kembali ke Halaman Utama
        </a>
        
        <!-- Print Button -->
        <button onclick="window.print()" class="block py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 w-full">
            <i class="fas fa-print mr-2"></i> Cetak Voucher
        </button>
    </div>
    
    <!-- Brand Footer -->
    <div class="mt-12 pt-8 border-t border-gray-200">
        <div class="text-2xl font-bold abc-red mb-2">ABC</div>
        <p class="text-gray-600">Ahlinya Buat Citarasa</p>
        <p class="text-sm text-gray-500 mt-6">© 2024 PromoMurahABC. Semua hak dilindungi.</p>
    </div>
</div>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .max-w-4xl, .max-w-4xl * {
            visibility: visible;
        }
        .max-w-4xl {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .no-print {
            display: none !important;
        }
    }
    
    /* Barcode font */
    @import url('https://fonts.googleapis.com/css2?family=Libre+Barcode+128&display=swap');
</style>

<script>
    // Add print-specific classes
    document.addEventListener('DOMContentLoaded', function() {
        const actionButtons = document.querySelector('.space-y-4');
        actionButtons.classList.add('no-print');
    });
</script>
@endsection
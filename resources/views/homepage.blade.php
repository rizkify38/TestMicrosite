@extends('layouts.app')

@section('title', 'PromoMurahABC - Tebus Voucher Potongan')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4 bg-gradient-to-br from-red-50 to-orange-50">
    <div class="max-w-4xl w-full text-center">
        <!-- Gambar promosi -->
        <div class="mb-10">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden inline-block">
                <!-- Tampilkan gambar Homepage.jpg secara responsif -->
                <img 
                    src="{{ asset('images/Homepage.jpg') }}" 
                    alt="PromoMurahABC - Tebus Voucher Potongan Rp 5.000"
                    class="w-full h-auto max-w-full"
                >
            </div>
        </div>
        
        <!-- CTA Button -->
        <div>
            <a href="{{ route('promo') }}" 
               class="btn-primary text-2xl px-16 py-6 inline-block animate-bounce hover:animate-none">
                Dapatkan Voucher Di Sini <i class="fas fa-arrow-right ml-4"></i>
            </a>
            
            <p class="text-gray-500 mt-8 text-lg">
                Klik tombol di atas untuk memilih produk dan dapatkan voucher
            </p>
        </div>
    </div>
</div>

<style>
    .btn-primary {
        background: linear-gradient(135deg, #d32f2f 0%, #b71c1c 100%);
        color: white;
        padding: 24px 60px;
        border-radius: 16px;
        font-weight: 900;
        border: none;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: inline-block;
        text-align: center;
        box-shadow: 0 15px 35px rgba(211, 47, 47, 0.4);
        position: relative;
        overflow: hidden;
        font-size: 1.5rem;
        letter-spacing: 1px;
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #b71c1c 0%, #9a0007 100%);
        transform: translateY(-8px) scale(1.08);
        box-shadow: 0 25px 50px rgba(211, 47, 47, 0.5);
    }
    
    .btn-primary:active {
        transform: translateY(-4px) scale(1.04);
    }
    
    /* Animasi bounce untuk menarik perhatian */
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }
    
    .animate-bounce {
        animation: bounce 2s infinite;
    }
    
    .hover\:animate-none:hover {
        animation: none;
    }
    
    /* Responsive design untuk gambar */
    @media (max-width: 768px) {
        .btn-primary {
            padding: 20px 40px;
            font-size: 1.25rem;
            width: 100%;
            max-width: 400px;
        }
    }
    
    @media (max-width: 480px) {
        .btn-primary {
            padding: 18px 30px;
            font-size: 1.125rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Efek konfeti saat halaman dimuat (opsional)
        function createConfetti() {
            const colors = ['#d32f2f', '#b71c1c', '#ff9800', '#ff5722'];
            const confettiCount = 50;
            
            for (let i = 0; i < confettiCount; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.cssText = `
                    position: fixed;
                    width: ${Math.random() * 10 + 5}px;
                    height: ${Math.random() * 10 + 5}px;
                    background: ${colors[Math.floor(Math.random() * colors.length)]};
                    top: -20px;
                    left: ${Math.random() * 100}vw;
                    border-radius: ${Math.random() > 0.5 ? '50%' : '0'};
                    opacity: ${Math.random() * 0.5 + 0.5};
                    z-index: 1000;
                    pointer-events: none;
                `;
                
                document.body.appendChild(confetti);
                
                // Animasi konfeti jatuh
                const animation = confetti.animate([
                    { transform: 'translateY(0) rotate(0deg)', opacity: 1 },
                    { transform: `translateY(${window.innerHeight}px) rotate(${Math.random() * 360}deg)`, opacity: 0 }
                ], {
                    duration: Math.random() * 3000 + 2000,
                    easing: 'cubic-bezier(0.215, 0.610, 0.355, 1)'
                });
                
                // Hapus elemen setelah animasi selesai
                animation.onfinish = () => confetti.remove();
            }
        }
        
        // Jalankan konfeti saat halaman dimuat
        setTimeout(createConfetti, 500);
        
        // Atau saat button dihover (opsional)
        const button = document.querySelector('.btn-primary');
        if (button) {
            button.addEventListener('mouseenter', createConfetti);
        }
    });
</script>
@endsection
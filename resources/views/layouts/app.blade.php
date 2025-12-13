<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - PromoMurahABC</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+128&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fef5f5 0%, #ffe9e9 100%);
            color: #333;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* ABC Brand Colors */
        .abc-red { color: #E31E24; }
        .bg-abc-red { background-color: #E31E24; }
        .border-abc-red { border-color: #E31E24; }
        
        /* Gradient Backgrounds */
        .bg-gradient-abc {
            background: linear-gradient(135deg, #E31E24 0%, #C41E3A 100%);
        }
        
        /* Button Styles */
        .btn-primary {
            background: linear-gradient(135deg, #E31E24 0%, #C41E3A 100%);
            color: white;
            padding: 1rem 2rem;
            border-radius: 12px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-block;
            text-align: center;
            box-shadow: 0 10px 25px rgba(227, 30, 36, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(227, 30, 36, 0.4);
        }
        
        .btn-primary:active {
            transform: translateY(-1px);
        }
        
        /* Card Styles */
        .card-modern {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .card-modern:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.12);
        }
        
        /* Product Card */
        .product-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }
        
        .product-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 60px rgba(227, 30, 36, 0.15);
        }
        
        /* Barcode */
        .barcode {
            font-family: 'Libre Barcode 128', cursive;
        }
        
        /* Input Styles */
        .input-modern {
            width: 100%;
            padding: 1rem 1.25rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }
        
        .input-modern:focus {
            outline: none;
            border-color: #E31E24;
            box-shadow: 0 0 0 4px rgba(227, 30, 36, 0.1);
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
        
        @keyframes pulse-slow {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }
        
        .animate-pulse-slow {
            animation: pulse-slow 3s ease-in-out infinite;
        }
        
        /* Responsive Typography */
        .text-responsive-xl {
            font-size: clamp(1.5rem, 4vw, 3rem);
        }
        
        .text-responsive-lg {
            font-size: clamp(1.25rem, 3vw, 2rem);
        }
        
        .text-responsive-base {
            font-size: clamp(0.875rem, 2vw, 1.125rem);
        }
        
        /* Container */
        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
        }
        
        @media (min-width: 640px) {
            .container-custom {
                padding: 1.5rem;
            }
        }
        
        @media (min-width: 1024px) {
            .container-custom {
                padding: 2rem;
            }
        }
        
        /* Floating Animation */
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>
<body>
    @yield('content')
    
    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
        
        // Add animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-up');
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.card-modern, .product-card').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>
</html>
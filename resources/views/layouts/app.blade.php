<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - PromoMurahABC</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+128&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f8f8f8 0%, #e9e9e9 100%);
            color: #333;
            min-height: 100vh;
        }
        
        .abc-red { color: #d32f2f; }
        .bg-abc-red { background-color: #d32f2f; }
        .border-abc-red { border-color: #d32f2f; }
        
        .btn-primary {
            background-color: #d32f2f;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
            text-align: center;
        }
        
        .btn-primary:hover {
            background-color: #b71c1c;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(211, 47, 47, 0.3);
        }
        
        .product-card {
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        
        .barcode {
            font-family: 'Libre Barcode 128', cursive;
            font-size: 2.5rem;
            letter-spacing: 2px;
        }
        
        .section-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            color: #222;
            position: relative;
            padding-bottom: 10px;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="container mx-auto px-4 py-6">
        @yield('content')
    </div>
    
    <script>
        // Fungsi untuk scroll ke bagian tertentu
        function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (section) {
                section.scrollIntoView({ behavior: 'smooth' });
            }
        }
        
        // Fungsi untuk toggle accordion syarat & ketentuan
        function toggleAccordion() {
            const accordion = document.getElementById('syaratAccordion');
            accordion.classList.toggle('hidden');
        }
        
        // Validasi form sebelum submit
        function validateForm() {
            const checkbox = document.getElementById('syaratCheckbox');
            const form = document.getElementById('voucherForm');
            
            if (!checkbox.checked) {
                alert('Harap centang persetujuan Syarat & Ketentuan');
                return false;
            }
            
            return true;
        }
    </script>
</body>
</html>
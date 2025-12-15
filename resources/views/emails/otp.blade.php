<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #E31E24 0%, #C41E3A 100%);
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            color: white;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            color: rgba(255,255,255,0.9);
            margin: 5px 0 0 0;
            font-size: 14px;
        }
        .content {
            padding: 40px 30px;
        }
        .content p {
            color: #333;
            line-height: 1.6;
            margin: 0 0 20px 0;
        }
        .otp-box {
            background: linear-gradient(135deg, #f5f5f5 0%, #e8e8e8 100%);
            border: 2px dashed #E31E24;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            margin: 30px 0;
        }
        .otp-label {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .otp-code {
            font-size: 48px;
            font-weight: bold;
            color: #E31E24;
            letter-spacing: 8px;
            font-family: 'Courier New', monospace;
        }
        .info-box {
            background: #FFF3CD;
            border-left: 4px solid #FFC107;
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .info-box p {
            margin: 0;
            color: #856404;
            font-size: 14px;
        }
        .footer {
            background: #f9f9f9;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #eee;
        }
        .footer p {
            color: #999;
            font-size: 12px;
            margin: 5px 0;
        }
        .brand {
            margin-top: 20px;
        }
        .brand h2 {
            color: #E31E24;
            margin: 0 0 5px 0;
            font-size: 28px;
        }
        .brand p {
            color: #666;
            margin: 0;
            font-size: 14px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔐 Kode Verifikasi OTP</h1>
            <p>Voucher Promo ABC - Alfamart</p>
        </div>
        
        <div class="content">
            <p>Halo,</p>
            <p>Terima kasih telah mengikuti promo voucher ABC di Alfamart. Gunakan kode OTP berikut untuk memverifikasi email Anda:</p>
            
            <div class="otp-box">
                <div class="otp-label">Kode OTP Anda</div>
                <div class="otp-code">{{ $otpCode }}</div>
            </div>
            
            <div class="info-box">
                <p><strong>⏰ Penting:</strong> Kode OTP ini berlaku selama <strong>5 menit</strong>. Jangan bagikan kode ini kepada siapapun.</p>
            </div>
            
            <p>Jika Anda tidak meminta kode OTP ini, abaikan email ini. Akun Anda tetap aman.</p>
            
            <div class="brand">
                <h2>ABC</h2>
                <p>Ahlinya Buat Citarasa</p>
            </div>
        </div>
        
        <div class="footer">
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
            <p>&copy; 2025 Promo ABC - Alfamart. Semua hak dilindungi.</p>
        </div>
    </div>
</body>
</html>

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OtpService;

class OtpController extends Controller
{
    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    /**
     * Send OTP to email
     */
    public function sendOtp(Request $request)
    {
        // Validate email
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = strtolower(trim($request->email));

        // Validate email domain (same whitelist as voucher form)
        if (!str_contains($email, '@')) {
            return response()->json([
                'success' => false,
                'message' => 'Format email tidak valid.'
            ], 400);
        }

        [$username, $domain] = explode('@', $email);

        $allowedDomains = [
            'gmail.com',
            'yahoo.com',
            'yahoo.co.id',
            'outlook.com',
            'hotmail.com',
            'icloud.com',
            'live.com',
            'aol.com',
        ];

        if (!in_array($domain, $allowedDomains)) {
            return response()->json([
                'success' => false,
                'message' => 'Email harus menggunakan domain yang valid (gmail.com, yahoo.com, outlook.com, dll). Domain "' . $domain . '" tidak diperbolehkan.'
            ], 400);
        }

        try {
            $this->otpService->generateAndSendOtp($email);

            return response()->json([
                'success' => true,
                'message' => 'Kode OTP telah dikirim ke email Anda. Silakan cek inbox atau folder spam.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Verify OTP code
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp_code' => 'required|string|size:6',
        ]);

        $email = strtolower(trim($request->email));
        $otpCode = $request->otp_code;

        try {
            $this->otpService->verifyOtp($email, $otpCode);

            return response()->json([
                'success' => true,
                'message' => 'Email berhasil diverifikasi!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}

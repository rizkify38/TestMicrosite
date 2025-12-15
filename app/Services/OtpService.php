<?php

namespace App\Services;

use App\Models\EmailOtp;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class OtpService
{
    /**
     * Generate dan kirim OTP ke email
     */
    public function generateAndSendOtp($email)
    {
        $email = strtolower(trim($email));
        
        // Generate 6-digit OTP
        $otpCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Delete old OTPs untuk email ini
        EmailOtp::byEmail($email)->delete();
        
        // Create new OTP record
        $otp = EmailOtp::create([
            'email' => $email,
            'otp_code' => $otpCode,
            'is_verified' => false,
            'expires_at' => Carbon::now()->addMinutes(5), // Valid 5 menit
        ]);
        
        // Send email
        try {
            Mail::to($email)->send(new OtpMail($otpCode));
        } catch (\Exception $e) {
            \Log::error('Failed to send OTP email: ' . $e->getMessage());
            throw new \Exception('Gagal mengirim email OTP. Silakan coba lagi.');
        }
        
        return $otp;
    }
    
    /**
     * Verify OTP code
     */
    public function verifyOtp($email, $otpCode)
    {
        $email = strtolower(trim($email));
        
        // Find valid OTP
        $otp = EmailOtp::byEmail($email)
                    ->valid()
                    ->where('otp_code', $otpCode)
                    ->first();
        
        if (!$otp) {
            // Check if OTP expired
            $expiredOtp = EmailOtp::byEmail($email)
                            ->where('otp_code', $otpCode)
                            ->where('expires_at', '<', now())
                            ->exists();
            
            if ($expiredOtp) {
                throw new \Exception('Kode OTP sudah kadaluarsa. Silakan kirim ulang OTP.');
            }
            
            throw new \Exception('Kode OTP salah. Silakan coba lagi.');
        }
        
        // Mark as verified
        $otp->update(['is_verified' => true]);
        
        return true;
    }
    
    /**
     * Check if email has verified OTP
     */
    public function isEmailVerified($email)
    {
        $email = strtolower(trim($email));
        
        return EmailOtp::byEmail($email)
                    ->verified()
                    ->where('created_at', '>', Carbon::now()->subHours(1)) // Valid dalam 1 jam terakhir
                    ->exists();
    }
    
    /**
     * Cleanup expired OTPs (untuk scheduled job)
     */
    public function cleanupExpiredOtps()
    {
        return EmailOtp::where('expires_at', '<', now())->delete();
    }
}

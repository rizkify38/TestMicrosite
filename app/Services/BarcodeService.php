<?php

namespace App\Services;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class BarcodeService
{
    /**
     * Generate barcode untuk voucher code
     * 
     * @param string $voucherCode
     * @return string Path ke barcode image
     */
    public function generateVoucherBarcode($voucherCode)
    {
        // Generate QR Code (meskipun namanya barcode, kita pakai QR code library)
        // Untuk barcode 1D, kita bisa pakai format text dengan font khusus
        // Atau generate QR code yang bisa di-scan
        
        $qrCode = QrCode::format('png')
                        ->size(400) // Increased from 300 to 400 for better scanning
                        ->margin(2)
                        ->generate($voucherCode);
        
        // Simpan ke storage
        $filename = 'barcodes/' . $voucherCode . '.png';
        Storage::disk('public')->put($filename, $qrCode);
        
        return $filename;
    }

    /**
     * Generate barcode dengan data lengkap voucher
     * 
     * @param array $voucherData
     * @return string Path ke barcode image
     */
    public function generateVoucherBarcodeWithData($voucherData)
    {
        // Encode data voucher ke JSON untuk QR code
        $data = json_encode([
            'code' => $voucherData['voucher_code'],
            'value' => $voucherData['nominal'] ?? 'Rp 5.000',
            'product' => $voucherData['product_name'] ?? '',
            'expired' => $voucherData['expired_date'] ?? '',
        ]);
        
        $qrCode = QrCode::format('png')
                        ->size(300)
                        ->margin(1)
                        ->generate($data);
        
        $filename = 'barcodes/' . $voucherData['voucher_code'] . '.png';
        Storage::disk('public')->put($filename, $qrCode);
        
        return $filename;
    }

    /**
     * Delete barcode file
     * 
     * @param string $path
     * @return bool
     */
    public function deleteBarcode($path)
    {
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }
        
        return false;
    }
}

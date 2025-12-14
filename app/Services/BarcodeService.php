<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;

class BarcodeService
{
    /**
     * Generate barcode untuk voucher code (1D Barcode - Code128)
     * 
     * @param string $voucherCode
     * @return string Path ke barcode image
     */
    public function generateVoucherBarcode($voucherCode)
    {
        try {
            // Generate 1D Barcode (Code128) menggunakan Milon Barcode
            // Format: PNG, Height: 80, Width: 2
            $barcode = DNS1D::getBarcodePNG($voucherCode, 'C128', 2, 80);
            
            // Decode base64 to binary
            $barcodeImage = base64_decode($barcode);
            
            // Simpan ke storage
            $filename = 'barcodes/' . $voucherCode . '.png';
            Storage::disk('public')->put($filename, $barcodeImage);
            
            return $filename;
            
        } catch (\Exception $e) {
            \Log::error('Barcode generation failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Generate barcode dengan data lengkap voucher
     * 
     * @param array $voucherData
     * @return string Path ke barcode image
     */
    public function generateVoucherBarcodeWithData($voucherData)
    {
        // Untuk barcode 1D, kita hanya encode voucher code
        // Data lain ditampilkan di UI
        return $this->generateVoucherBarcode($voucherData['voucher_code']);
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

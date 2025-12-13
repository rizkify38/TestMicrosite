<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Promo untuk ABC Kecap Manis (ID: 79760)
        \App\Models\Promo::create([
            'promo_code' => '79760',
            'name' => 'DGM ABC-HEMAT SPESIAL-PERIODE 16 DESEMBER 2025 SD 14 FEBRUARI 2026',
            'description' => 'Voucher pot. 5.000 ABC Kecap Manis December 2025',
            'product_type' => 'kecap',
            'voucher_value' => 5000,
            'min_purchase' => 25000,
            'start_date' => '2025-12-16',
            'end_date' => '2026-02-14',
            'is_active' => true,
        ]);

        // Promo untuk ABC Sambal Asli (ID: 79759)
        \App\Models\Promo::create([
            'promo_code' => '79759',
            'name' => 'DGM ABC-HEMAT SPESIAL-PERIODE 16 DESEMBER 2025 SD 14 FEBRUARI 2026',
            'description' => 'Voucher pot. 5.000 ABC Sambal Asli December 2025',
            'product_type' => 'sambal',
            'voucher_value' => 5000,
            'min_purchase' => 25000,
            'start_date' => '2025-12-16',
            'end_date' => '2026-02-14',
            'is_active' => true,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VoucherCode;
use Illuminate\Support\Facades\DB;

class VoucherCodeSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/voucher_codes.csv');

        if (!file_exists($path)) {
            $this->command->error('CSV file not found!');
            return;
        }

        $file = fopen($path, 'r');

        // Ambil header & bersihin BOM
        $header = fgetcsv($file);
        $header = array_map(function ($h) {
            return trim(str_replace("\xEF\xBB\xBF", '', $h));
        }, $header);

        $data = [];

        while (($row = fgetcsv($file)) !== false) {
            if (count($row) !== count($header)) continue;

            $row = array_combine($header, $row);

            if (empty($row['code'])) continue;

            $data[] = [
                'code' => trim($row['code']),
                'product_type' => trim($row['product_type']),
                'is_claimed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        fclose($file);

        // Insert batch (AMAN buat 10.000+ data)
        foreach (array_chunk($data, 1000) as $chunk) {
            VoucherCode::insert($chunk);
        }

        $this->command->info('✅ Imported ' . count($data) . ' voucher codes');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('voucher_claims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voucher_code_id')->constrained('voucher_codes')->onDelete('cascade');
            
            // Customer data
            $table->string('customer_name');
            $table->string('customer_email')->unique(); // 1 email = 1 voucher
            $table->string('customer_phone', 15);
            
            // Product info (redundant tapi untuk kemudahan query)
            $table->enum('product_type', ['kecap', 'sambal']);
            $table->string('product_name');
            
            // QR Code
            $table->string('barcode_path')->nullable();
            
            // Expiry
            $table->date('expired_at'); // 2026-02-14
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher_claims');
    }
};

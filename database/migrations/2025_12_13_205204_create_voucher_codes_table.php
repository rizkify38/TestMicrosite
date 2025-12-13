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
        Schema::create('voucher_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code', 12)->unique(); // C000B76EAZUL (dari Excel)
            $table->enum('product_type', ['kecap', 'sambal']); // Dari sheet mana
            $table->boolean('is_claimed')->default(false); // Sudah diambil user?
            $table->timestamp('claimed_at')->nullable(); // Kapan di-claim
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher_codes');
    }
};

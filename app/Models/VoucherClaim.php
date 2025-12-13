<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoucherClaim extends Model
{
    protected $fillable = [
        'voucher_code_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'product_type',
        'product_name',
        'barcode_path',
        'expired_at',
    ];

    protected $casts = [
        'expired_at' => 'date',
    ];

    // Relationships
    public function voucherCode()
    {
        return $this->belongsTo(VoucherCode::class);
    }

    // Scopes
    public function scopeByEmail($query, $email)
    {
        return $query->where('customer_email', $email);
    }
}

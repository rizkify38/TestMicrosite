<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'voucher_code',
        'customer_name',
        'customer_email',
        'customer_phone',
        'product_type',
        'product_name',
        'barcode_path',
        'is_used',
        'used_at',
        'expired_at',
    ];

    protected $casts = [
        'is_used' => 'boolean',
        'used_at' => 'datetime',
        'expired_at' => 'date',
    ];

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('is_used', false)
                    ->where('expired_at', '>=', now());
    }

    public function scopeUsed($query)
    {
        return $query->where('is_used', true);
    }

    public function scopeExpired($query)
    {
        return $query->where('expired_at', '<', now());
    }
    
    public function scopeByEmail($query, $email)
    {
        return $query->where('customer_email', $email);
    }
}

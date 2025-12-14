<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoucherCode extends Model
{
    protected $fillable = [
        'code',
        'product_type',
        'is_claimed',
        'claimed_at',
    ];

    protected $casts = [
        'is_claimed' => 'boolean',
        'claimed_at' => 'datetime',
    ];

    // Relationship
    public function claim()
    {
        return $this->hasOne(VoucherClaim::class, 'voucher_code_id');
    }

    // Scopes
    public function scopeUnclaimed($query)
    {
        return $query->where('is_claimed', false);
    }

    public function scopeByProductType($query, $type)
    {
        return $query->where('product_type', $type);
    }
}

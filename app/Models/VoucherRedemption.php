<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoucherRedemption extends Model
{
    protected $fillable = [
        'voucher_id',
        'redeemed_by',
        'store_code',
        'transaction_amount',
    ];

    // Relationships
    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}

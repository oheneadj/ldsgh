<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'payment_id',         // links to payment
        'transaction_gateway',// e.g., Stripe, PayPal, Flutterwave
        'status',             // pending, completed, failed
        'amount',             // optional, can differ if partial/refund
        'currency',           // e.g., USD, NGN
        'raw_response',       // JSON column for gateway response
        'reference',          // unique transaction reference
    ];

    /**
     * Relationships
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}

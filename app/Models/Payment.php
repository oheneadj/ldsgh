<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
   protected $fillable = [
        'service_request_id', // links to the service request
        'amount',
        'payment_method',     // e.g., card, cash, mobile money
        'status',             // pending, completed, failed
            // optional, for tracking
    ];

    /**
     * Relationships
     */

    // The service request this payment belongs to
    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class);
    }
}

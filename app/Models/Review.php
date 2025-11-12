<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
   protected $fillable = [
        'service_request_id',  // the request being reviewed
        'driver_profile_id',   // driver being reviewed
        'customer_profile_id', // who left the review
        'rating',              // numerical rating, e.g., 1-5
        'comment',             // optional text feedback
    ];

    /**
     * Relationships
     */

    // Service request being reviewed
    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class);
    }

    // Driver being reviewed
    public function driver()
    {
        return $this->belongsTo(DriverProfile::class, 'driver_profile_id');
    }

    // Customer who left the review
    public function customer()
    {
        return $this->belongsTo(CustomerProfile::class, 'customer_profile_id');
    }
}

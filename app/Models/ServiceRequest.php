<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
  
    protected $fillable = [
        'customer_profile_id',
        'driver_profile_id',
        'vehicle_id',
        'type',
        'vehicle_type',
        'pickup_address',
        'pickup_latitude',
        'pickup_longitude',
        'dropoff_address',
        'dropoff_latitude',
        'dropoff_longitude',
        'distance',
        'weight',
        'price',
        'status',
    ];

    /**
     * Relationships
     */

    // Customer who made the request
    public function customer()
    {
        return $this->belongsTo(CustomerProfile::class, 'customer_profile_id');
    }

    // Assigned driver
    public function driverProfile()
    {
        return $this->belongsTo(DriverProfile::class, 'driver_profile_id');
    }

    // Vehicle used
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Reviews for this service request
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Payment for this service request
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}

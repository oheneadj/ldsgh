<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
     protected $fillable = [
        'driver_profile_id',
        'type',       // e.g., bike, car, van
        'model',
        'plate_number'
    ];

    /**
     * Relationships
     */

    // Vehicle belongs to a driver profile
    public function driverProfile()
    {
        return $this->belongsTo(DriverProfile::class);
    }

    // Optional: vehicle can have many service requests (if needed)
    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class, 'vehicle_id');
    }
}

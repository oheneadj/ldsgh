<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    protected $fillable = [
        'vehicle_type',   // e.g., bike, car, van, truck
        'license_plate',
        'brand',
        'model',
        'color',
        'capacity',       // e.g., max weight in kg or number of passengers
        'status',         // available, in_service, maintenance
    ];

    /**
     * Relationships
     */

    // Drivers who can use this vehicle
    public function drivers()
    {
        return $this->hasMany(DriverProfile::class);
    }

    // Service requests that used this vehicle
    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class);
    }
}

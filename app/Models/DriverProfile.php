<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverProfile extends Model
{
    protected $fillable = [
        'user_id',
        'license_number',
        'license_image',
        'is_available',
        'current_latitude',
        'current_longitude',
        'rating',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'current_latitude' => 'decimal:8',
        'current_longitude' => 'decimal:8',
        'rating' => 'decimal:2',
    ];


    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function scopeUnavailable($query)
    {
        return $query->where('is_available', false);
    }


     /**
     * Relationships
     */

    // Link to the User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // One driver has one vehicle
    public function vehicle()
    {
        return $this->hasOne(Vehicle::class);
    }

    // One driver profile has many service requests assigned
    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class);
    }

    // One driver profile has many reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Accessor for average rating
     */
    public function getAverageRatingAttribute()
    {
        return round($this->reviews()->avg('rating'), 2) ?? 0;
    }

    // Optional: number of reviews
    public function getReviewsCountAttribute()
    {
        return $this->reviews()->count();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerProfile extends Model
{
     protected $fillable = [
        'user_id',
        'default_address',
        'phone',          // optional if different from users table
        'preferences',    // JSON or text for any customer preferences
    ];

    /**
     * Relationships
     */

    // Link to the user account
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Customer's service requests
    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class);
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Panel;
use App\Models\Review;
use App\Models\Payment;
use Illuminate\Support\Str;
use App\Models\DriverProfile;
use App\Models\ServiceRequest;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'role',
        'email',
        'password',
        'phone',
        'is_active',
        'profile_photo_path',
        'verification_code',
        'email_verified_at',
        'phone_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }
    //Filament access control
 public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === "admin";
    }

   /**
     * Relationships
     */

    // Customer: has many service requests
   // User model relationships

public function serviceRequests()
{
    return $this->hasMany(ServiceRequest::class, 'customer_profile_id');
}

public function driverProfile():HasOne
{
    return $this->hasOne(DriverProfile::class, 'user_id');
}

public function reviews()
{
    return $this->hasMany(Review::class, 'customer_profile_id');
}
public function payments()
{
    return $this->hasManyThrough(
        Payment::class,
        ServiceRequest::class,
        'customer_profile_id', // FK on ServiceRequest
        'service_request_id',  // FK on Payment
        'id',                  // Local key on User
        'id'                   // Local key on ServiceRequest
    );
}


}

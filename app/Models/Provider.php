<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Provider extends Authenticatable
{
    // Combined all traits: HasFactory and Notifiable for Auth, SoftDeletes for safe deletion
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     * Merged from both files.
     */
    protected $fillable = [
        'name',
        'provider', // Included from 1st file
        'email',
        'password',
        'city',
        'phone',
        'experience',
        'service',
        'status',
        'image',
        'subscription_status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     * Note: 'deleted_at' is handled automatically by the SoftDeletes trait in modern Laravel.
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'email_verified_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Get the bookings for the provider.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the services offered by this provider.
     */
    public function providerServices(): HasMany
    {
        return $this->hasMany(ProviderService::class);
    }
}

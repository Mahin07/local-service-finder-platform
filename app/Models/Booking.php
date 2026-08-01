<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bookings';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'service_id',
        'provider_id',
        'provider_service_id',
        'booking_date',
        'customer_phone',
        'customer_address',
        'status',
        'finished_at',
    ];

    /**
     * Get the attributes that should be cast.
     * Combines both cast lists.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'booking_date' => 'date',
            'finished_at' => 'datetime',
        ];
    }

    /**
     * Mutator to handle multiple date input formats.
     */
    public function setBookingDateAttribute($value): void
    {
        if (blank($value)) {
            $this->attributes['booking_date'] = null;

            return;
        }

        // List of potential formats to try parsing
        $formats = ['d-m-y', 'd/m/y', 'd-m-Y', 'd/m/Y', 'Y-m-d'];

        foreach ($formats as $format) {
            try {
                $date = Carbon::createFromFormat($format, (string) $value);
                if ($date !== false) {
                    $this->attributes['booking_date'] = $date->format('Y-m-d');

                    return;
                }
            } catch (\Throwable $e) {
                continue;
            }
        }

        // Fallback if no format matches
        $this->attributes['booking_date'] = $value;
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function providerService(): BelongsTo
    {
        return $this->belongsTo(ProviderService::class, 'provider_service_id');
    }
}

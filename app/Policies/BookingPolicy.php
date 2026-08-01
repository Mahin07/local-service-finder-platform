<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\Provider;
use App\Models\User;

class BookingPolicy
{
    public function downloadInvoice(User $user, Booking $booking): bool
    {
        return (int) $booking->user_id === (int) $user->id;
    }

    public function manage(Provider $provider, Booking $booking): bool
    {
        return (int) $booking->provider_id === (int) $provider->id;
    }
}

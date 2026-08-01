<?php

namespace App\Actions\Bookings;

use App\Models\Booking;
use App\Models\Category;
use App\Models\ProviderService;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CreateBookingAction
{
    /**
     * Create the normalized booking records for a customer and provider service.
     *
     * @param array{booking_date: string, customer_phone: string, customer_address: string} $details
     */
    public function execute(User $user, ProviderService $providerService, array $details): Booking
    {
        return DB::transaction(function () use ($user, $providerService, $details): Booking {
            $category = Category::firstOrCreate(
                ['name' => $providerService->category],
                ['description' => $providerService->category, 'status' => true]
            );

            $service = Service::firstOrCreate(
                [
                    'name' => $providerService->title,
                    'category_id' => $category->id,
                ],
                [
                    'description' => $providerService->description,
                    'price' => $providerService->price,
                ]
            );

            return Booking::create([
                'user_id' => $user->id,
                'service_id' => $service->id,
                'provider_id' => $providerService->provider_id,
                'provider_service_id' => $providerService->id,
                'booking_date' => $details['booking_date'],
                'customer_phone' => $details['customer_phone'],
                'customer_address' => $details['customer_address'],
                'status' => 'pending',
            ]);
        });
    }
}

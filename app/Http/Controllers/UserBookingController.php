<?php

namespace App\Http\Controllers;

use App\Actions\Bookings\CreateBookingAction;
use App\Models\ProviderService;
use App\Services\BookingNotificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserBookingController extends Controller
{
    public function __construct(
        protected BookingNotificationService $notificationService,
        protected CreateBookingAction $createBooking,
    ) {}

    public function create(ProviderService $providerService): View
    {
        abort_unless(
            $providerService->is_active && $providerService->provider && $providerService->provider->status === 'approved',
            404
        );

        $providerService->load('provider');

        return view('user.book_service', [
            'providerService' => $providerService,
        ]);
    }

    public function store(Request $request, ProviderService $providerService): RedirectResponse
    {
        abort_unless(
            $providerService->is_active && $providerService->provider && $providerService->provider->status === 'approved',
            404
        );

        $validated = $request->validate([
            'booking_date' => ['required', 'date', 'after_or_equal:today'],
            'customer_phone' => ['required', 'string', 'max:30'],
            'customer_address' => ['required', 'string', 'max:1000'],
        ]);

        $booking = $this->createBooking->execute($request->user(), $providerService, $validated);

        if ($providerService->provider) {
            $booking->loadMissing(['user', 'providerService']);
            $this->notificationService->notifyProviderOfNewBooking($providerService->provider, $booking);
        }

        return redirect()
            ->route('services.booking.create', $providerService)
            ->with('success', 'Your booking request has been sent to the provider.');
    }
}

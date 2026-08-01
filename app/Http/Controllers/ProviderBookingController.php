<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Services\BookingNotificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ProviderBookingController extends Controller
{
    public function __construct(
        protected BookingNotificationService $notificationService
    ) {}

    public function index(): View
    {
        $provider = Auth::guard('provider')->user();

        $bookings = Booking::query()
            ->with(['user', 'providerService'])
            ->where('provider_id', $provider->id)
            ->latest()
            ->get();

        return view('provider.bookings.index', [
            'provider' => $provider,
            'bookings' => $bookings,
        ]);
    }

    public function approve(Request $request, Booking $booking): RedirectResponse
    {
        $provider = Auth::guard('provider')->user();

        Gate::forUser($provider)->authorize('manage', $booking);

        $booking->loadMissing(['user', 'providerService']);

        abort_unless($booking->status === 'pending', 422);

        $booking->update([
            'status' => 'approved',
            'finished_at' => null,
        ]);

        $this->notificationService->notifyCustomerOfApproval($booking, $provider);

        return redirect()
            ->route('provider.bookings.index')
            ->with('success', 'Booking approved successfully.');
    }

    public function finish(Request $request, Booking $booking): RedirectResponse
    {
        $provider = Auth::guard('provider')->user();

        Gate::forUser($provider)->authorize('manage', $booking);

        $booking->loadMissing(['user', 'providerService']);

        abort_unless($booking->status === 'approved', 422);

        $booking->update([
            'status' => 'finished',
            'finished_at' => now(),
        ]);

        $this->notificationService->notifyCustomerOfCompletion($booking, $provider);

        return redirect()
            ->route('provider.bookings.index')
            ->with('success', 'Service marked as finished. Customer can now download the bill.');
    }
}

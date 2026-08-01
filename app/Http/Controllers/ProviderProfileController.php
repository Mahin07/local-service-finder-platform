<?php

namespace App\Http\Controllers;

use App\Services\PublicImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProviderProfileController extends Controller
{
    public function __construct(private readonly PublicImageUploadService $imageUploader) {}

    public function __invoke(): View
    {
        return $this->profileView();
    }

    public function update(Request $request): RedirectResponse
    {
        $provider = Auth::guard('provider')->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('providers', 'email')->ignore($provider->id)],
            'phone' => ['required', 'string', 'max:30'],
            'city' => ['required', 'string', 'max:120'],
            'service' => ['required', 'string', 'max:255'],
            'experience' => ['nullable', 'string', 'max:120'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->imageUploader->store(
                $request->file('image'),
                'uploads/providers'
            );
        }

        $provider->update($validated);

        return redirect()
            ->route('provider.profile')
            ->with('success', 'Your provider profile has been updated successfully.');
    }

    private function profileView(): View
    {
        $provider = Auth::guard('provider')->user();

        $provider->loadCount([
            'bookings as total_bookings',
            'bookings as approved_bookings' => fn ($query) => $query->where('status', 'approved'),
            'bookings as finished_bookings' => fn ($query) => $query->where('status', 'finished'),
            'providerServices as live_services' => fn ($query) => $query->where('is_active', true),
        ]);

        $latestBooking = $provider->bookings()
            ->with([
                'user:id,name',
                'providerService:id,title',
            ])
            ->latest()
            ->first();

        $latestService = $provider->providerServices()
            ->select(['id', 'provider_id', 'title', 'is_active', 'created_at'])
            ->latest()
            ->first();

        return view('provider.profile', [
            'provider' => $provider,
            'totalBookings' => $provider->total_bookings,
            'approvedBookings' => $provider->approved_bookings,
            'finishedBookings' => $provider->finished_bookings,
            'liveServices' => $provider->live_services,
            'latestBooking' => $latestBooking,
            'latestService' => $latestService,
        ]);
    }
}

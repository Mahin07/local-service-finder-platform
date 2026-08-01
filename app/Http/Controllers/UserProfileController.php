<?php

namespace App\Http\Controllers;

use App\Services\PublicImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserProfileController extends Controller
{
    public function __construct(private readonly PublicImageUploadService $imageUploader) {}

    public function __invoke(): View
    {
        return $this->profileView();
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'address' => ['nullable', 'string', 'max:1000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->imageUploader->store(
                $request->file('image'),
                'uploads/users'
            );
        }

        if (($validated['email'] ?? null) !== $user->email) {
            $validated['email_verified_at'] = null;
        }

        $user->update($validated);

        return redirect()
            ->route('profile')
            ->with('success', 'Your profile has been updated successfully.');
    }

    private function profileView(): View
    {
        $user = Auth::user();
        $totalBookings = $user->bookings()->count();
        $approvedBookings = $user->bookings()->where('status', 'approved')->count();
        $finishedBookings = $user->bookings()->where('status', 'finished')->count();
        $latestBooking = $user->bookings()->with(['provider', 'providerService'])->latest()->first();

        return view('user.profile', compact(
            'user',
            'totalBookings',
            'approvedBookings',
            'finishedBookings',
            'latestBooking'
        ));
    }
}

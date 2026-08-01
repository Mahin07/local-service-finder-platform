<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Services\PublicImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderAuthController extends Controller
{
    public function __construct(private readonly PublicImageUploadService $imageUploader) {}

    public function showRegisterForm()
    {
        return view('provider.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:providers,email',
            'phone' => 'required|string|max:30',
            'city' => 'required|string|max:120',
            'service' => 'required|string|max:255',
            'experience' => 'nullable|string|max:120',
            'password' => 'required|string|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $request->hasFile('image')
            ? $this->imageUploader->store($request->file('image'), 'uploads/providers')
            : null;

        $provider = Provider::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'city' => $validated['city'],
            'service' => $validated['service'],
            'experience' => $validated['experience'] ?? null,
            'password' => $validated['password'],
            'image' => $imagePath,
            'status' => 'pending',
            'subscription_status' => 'unpaid',
        ]);

        Auth::guard('provider')->login($provider);
        $request->session()->regenerate();

        return redirect()->route('provider.dashboard')
            ->with('success', 'Provider account created successfully. Your profile is pending approval.');
    }

    public function showLoginForm()
    {
        return view('user.login', [
            'loginType' => 'provider',
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $provider = Provider::where('email', $credentials['email'])->first();

        if ($provider && $provider->status === 'rejected') {
            return back()
                ->withErrors(['email' => 'Your provider application was rejected. Please contact admin before logging in again.'])
                ->withInput([
                    'email' => $request->input('email'),
                    'login_type' => 'provider',
                ]);
        }

        if (Auth::guard('provider')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('provider.dashboard'));
        }

        return back()
            ->withErrors(['email' => 'Invalid provider email or password.'])
            ->withInput([
                'email' => $request->input('email'),
                'login_type' => 'provider',
            ]);
    }

    public function dashboard()
    {
        $provider = Auth::guard('provider')->user();
        $bookings = $provider->bookings()->with(['user', 'providerService'])->latest()->take(5)->get();
        $providerServices = $provider->providerServices()->latest()->take(5)->get();

        return view('provider.dashboard', [
            'provider' => $provider,
            'bookings' => $bookings,
            'providerServices' => $providerServices,
            'stats' => [
                'total_bookings' => $provider->bookings()->count(),
                'pending_bookings' => $provider->bookings()->where('status', 'pending')->count(),
                'approved_bookings' => $provider->bookings()->where('status', 'approved')->count(),
                'published_services' => $provider->providerServices()->where('is_active', true)->count(),
            ],
            'statusNotice' => match ($provider->status) {
                'pending' => 'Your profile is under review. Admin approval is required before you can be treated as an active provider.',
                'approved' => 'Your provider profile has been approved. You are now active on the platform.',
                'rejected' => 'Your provider profile was rejected. Please contact admin for next steps.',
                default => null,
            },
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('provider')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('provider.login')->with('success', 'Provider logged out successfully.');
    }
}

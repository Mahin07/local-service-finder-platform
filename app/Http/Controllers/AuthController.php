<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function showAuth(Request $request)
    {
        $mode = $request->is('register') ? 'register' : 'login';

        return view('user.auth', [
            'mode' => $mode,
            'recaptchaSiteKey' => config('services.recaptcha.site_key', ''),
        ]);
    }

    public function register(Request $request)
    {
        if (! $this->isHumanRequest($request)) {
            return back()->withErrors(['captcha' => 'Captcha verification failed. Please try again.'])->withInput();
        }

        if (! empty($request->input('website'))) {
            return back()->withErrors(['captcha' => 'Invalid submission detected.'])->withInput();
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $tempImagePath = null;

        if ($request->hasFile('image')) {
            $tempImagePath = $request->file('image')->store('tmp_reg', 'local');
        }

        $otp = (string) random_int(100000, 999999);

        $request->session()->put('register_otp', [
            'code' => $otp,
            'expires_at' => now()->addMinutes(10)->timestamp,
            'pending_user' => [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'address' => $validated['address'] ?? null,
                'temp_image' => $tempImagePath,
            ],
        ]);

        try {
            Mail::raw("Your LocalServices OTP is: {$otp}. It expires in 10 minutes.", function ($message) use ($validated) {
                $message->to($validated['email'])
                    ->subject('Your LocalServices Registration OTP');
            });
        } catch (\Throwable $e) {
            if ($tempImagePath) {
                $fullTempPath = storage_path('app/'.$tempImagePath);
                if (file_exists($fullTempPath)) {
                    @unlink($fullTempPath);
                }
            }

            $request->session()->forget('register_otp');

            return back()
                ->withErrors(['email' => 'OTP email could not be sent. Please check mail settings and try again.'])
                ->withInput();
        }

        $mailNotice = config('mail.default') === 'log'
            ? 'OTP generated. Mail driver is LOG, so check storage/logs/laravel.log.'
            : 'OTP has been sent to your email.';

        return redirect()->route('register.otp')->with('success', $mailNotice);
    }

    public function showOtpForm(Request $request)
    {
        if (! $request->session()->has('register_otp')) {
            return redirect()->route('register')->withErrors(['email' => 'Please register first.']);
        }

        return view('user.register_otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $otpData = $request->session()->get('register_otp');

        if (! $otpData || ! isset($otpData['pending_user'])) {
            return redirect()->route('register')->withErrors(['email' => 'OTP session expired. Please register again.']);
        }

        if (now()->timestamp > (int) $otpData['expires_at']) {
            $this->cleanupTempImage($otpData['pending_user']['temp_image'] ?? null);
            $request->session()->forget('register_otp');

            return redirect()->route('register')->withErrors(['otp' => 'OTP expired. Please register again.']);
        }

        if ((string) $request->otp !== (string) $otpData['code']) {
            return back()->withErrors(['otp' => 'Invalid OTP code.']);
        }

        $pending = $otpData['pending_user'];

        if (User::where('email', $pending['email'])->exists()) {
            $this->cleanupTempImage($pending['temp_image'] ?? null);
            $request->session()->forget('register_otp');

            return redirect()->route('login')->withErrors(['email' => 'This email is already registered. Please login.']);
        }

        $userData = [
            'name' => $pending['name'],
            'email' => $pending['email'],
            'password' => $pending['password'],
            'address' => $pending['address'] ?? null,
        ];

        $imagePath = $this->moveTempImageToPublic($pending['temp_image'] ?? null);
        if ($imagePath) {
            $userData['image'] = $imagePath;
        }

        $user = User::create($userData);
        $user->email_verified_at = now();
        $user->save();

        $request->session()->forget('register_otp');

        return redirect()->route('login')->with('success', 'Registration complete. You can now sign in.');
    }

    public function resendOtp(Request $request)
    {
        $otpData = $request->session()->get('register_otp');

        if (! $otpData || ! isset($otpData['pending_user'])) {
            return redirect()->route('register')->withErrors(['email' => 'Please register first.']);
        }

        $otp = (string) random_int(100000, 999999);
        $otpData['code'] = $otp;
        $otpData['expires_at'] = now()->addMinutes(10)->timestamp;
        $request->session()->put('register_otp', $otpData);

        try {
            Mail::raw("Your new LocalServices OTP is: {$otp}. It expires in 10 minutes.", function ($message) use ($otpData) {
                $message->to($otpData['pending_user']['email'])
                    ->subject('Your LocalServices Registration OTP');
            });
        } catch (\Throwable $e) {
            return back()->withErrors(['otp' => 'Could not resend OTP right now. Please try again.']);
        }

        $mailNotice = config('mail.default') === 'log'
            ? 'New OTP generated. Mail driver is LOG, so check storage/logs/laravel.log.'
            : 'A new OTP has been sent to your email.';

        return back()->with('success', $mailNotice);
    }

    public function login(Request $request)
    {
        if (! $this->isHumanRequest($request)) {
            return back()->withErrors(['captcha' => 'Captcha verification failed. Please try again.'])->withInput();
        }

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt([...$credentials, 'status' => 'active'], $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        return back()
            ->withErrors(['email' => 'Invalid email or password.'])
            ->withInput([
                'email' => $request->input('email'),
                'login_type' => 'user',
            ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function passkeyRegisterOptions(Request $request)
    {
        return $this->passkeyUnavailableResponse();
    }

    public function passkeyRegisterVerify(Request $request)
    {
        return $this->passkeyUnavailableResponse();
    }

    public function passkeyLoginOptions(Request $request)
    {
        return $this->passkeyUnavailableResponse();
    }

    public function passkeyLoginVerify(Request $request)
    {
        return $this->passkeyUnavailableResponse();
    }

    private function moveTempImageToPublic(?string $tempImage): ?string
    {
        if (! $tempImage || ! Storage::disk('local')->exists($tempImage)) {
            return null;
        }

        $finalPath = 'uploads/users/'.basename($tempImage);
        $stream = Storage::disk('local')->readStream($tempImage);

        if ($stream === false || ! Storage::disk('public')->writeStream($finalPath, $stream)) {
            if (is_resource($stream)) {
                fclose($stream);
            }

            return null;
        }

        fclose($stream);
        Storage::disk('local')->delete($tempImage);

        return 'storage/'.$finalPath;
    }

    private function cleanupTempImage(?string $tempImage): void
    {
        if (! $tempImage) {
            return;
        }

        Storage::disk('local')->delete($tempImage);
    }

    private function isHumanRequest(Request $request): bool
    {
        $secret = config('services.recaptcha.secret');
        $token = $request->input('captcha_token');

        if (! $secret) {
            return app()->environment('local');
        }

        if (! $token) {
            return false;
        }

        try {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $secret,
                'response' => $token,
                'remoteip' => $request->ip(),
            ]);

            $json = $response->json();
            if (! is_array($json) || ! ($json['success'] ?? false)) {
                return false;
            }

            if (isset($json['score']) && (float) $json['score'] < 0.5) {
                return false;
            }

            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }

    private function passkeyUnavailableResponse()
    {
        return response()->json([
            'message' => 'Passkey login is temporarily unavailable until full WebAuthn verification is implemented securely.',
        ], 503);
    }
}

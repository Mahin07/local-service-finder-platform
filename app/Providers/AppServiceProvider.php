<?php

namespace App\Providers;

use App\Models\Booking;
use App\Models\ProviderService;
use App\Policies\BookingPolicy;
use App\Policies\ProviderServicePolicy;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Booking::class, BookingPolicy::class);
        Gate::policy(ProviderService::class, ProviderServicePolicy::class);

        ResetPassword::createUrlUsing(function ($notifiable, string $token): string {
            $path = route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false);

            $request = request();
            $baseUrl = $request ? $request->getSchemeAndHttpHost() : rtrim((string) config('app.url'), '/');

            return rtrim($baseUrl, '/').$path;
        });
    }
}

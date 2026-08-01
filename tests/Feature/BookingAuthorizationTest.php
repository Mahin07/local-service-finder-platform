<?php

namespace Tests\Feature;

use App\Http\Controllers\ProviderBookingController;
use App\Http\Controllers\UserInvoiceController;
use App\Models\Booking;
use App\Models\Provider;
use App\Models\User;
use App\Services\BookingNotificationService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class BookingAuthorizationTest extends TestCase
{
    public function test_customer_cannot_download_another_customers_invoice(): void
    {
        $request = Request::create('/my-bookings/2/invoice');
        $request->setUserResolver(function (): User {
            $user = new User();
            $user->id = 1;

            return $user;
        });

        $booking = new Booking();
        $booking->user_id = 2;

        $this->expectException(AuthorizationException::class);

        app(UserInvoiceController::class)($request, $booking);
    }

    public function test_provider_cannot_approve_another_providers_booking(): void
    {
        $provider = new Provider();
        $provider->id = 1;

        $booking = new Booking();
        $booking->provider_id = 2;

        $guard = \Mockery::mock();
        $guard->shouldReceive('user')->once()->andReturn($provider);
        Auth::shouldReceive('guard')->once()->with('provider')->andReturn($guard);

        $this->expectException(AuthorizationException::class);

        app(ProviderBookingController::class)->approve(new Request(), $booking);
    }

    public function test_provider_cannot_finish_another_providers_booking(): void
    {
        $provider = new Provider();
        $provider->id = 1;

        $booking = new Booking();
        $booking->provider_id = 2;

        $guard = \Mockery::mock();
        $guard->shouldReceive('user')->once()->andReturn($provider);
        Auth::shouldReceive('guard')->once()->with('provider')->andReturn($guard);

        $this->expectException(AuthorizationException::class);

        app(ProviderBookingController::class)->finish(new Request(), $booking);
    }
}

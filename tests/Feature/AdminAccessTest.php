<?php

namespace Tests\Feature;

use App\Http\Middleware\EnsureAdminAuthenticated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    public function test_guests_cannot_access_the_admin_dashboard(): void
    {
        $guard = \Mockery::mock();
        $guard->shouldReceive('check')->once()->andReturnFalse();
        Auth::shouldReceive('guard')->once()->with('admin')->andReturn($guard);

        $response = app(EnsureAdminAuthenticated::class)->handle(
            Request::create('/admin/dashboard'),
            fn () => response('This callback must not be reached.')
        );

        $this->assertTrue($response->isRedirect(route('admin.login')));
    }
}

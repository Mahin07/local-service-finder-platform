<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserBookingListController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = Auth::user();

        $bookings = $user->bookings()
            ->with(['provider', 'providerService', 'service'])
            ->latest()
            ->get();

        return view('user.my_bookings', [
            'bookings' => $bookings,
            'user' => $user,
        ]);
    }
}

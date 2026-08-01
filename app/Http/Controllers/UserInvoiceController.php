<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class UserInvoiceController extends Controller
{
    public function __invoke(Request $request, Booking $booking): Response
    {
        Gate::forUser($request->user())->authorize('downloadInvoice', $booking);

        $booking->loadMissing(['user', 'provider', 'providerService', 'service']);

        abort_unless($booking->status === 'finished', 404);

        $pdf = Pdf::loadView('user.invoice_pdf', [
            'booking' => $booking,
        ])->setPaper('a4');

        return $pdf->download('invoice-booking-'.$booking->id.'.pdf');
    }
}

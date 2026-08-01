<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Provider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class BookingNotificationService
{
    public function notifyProviderOfNewBooking(Provider $provider, Booking $booking): void
    {
        if (blank($provider->email)) {
            return;
        }

        $serviceTitle = $booking->providerService?->title ?: 'Requested service';
        $bookingDate = $booking->booking_date?->format('d M Y') ?: 'Not selected';
        $customerName = $booking->user?->name ?: 'Customer';
        $customerPhone = $booking->customer_phone ?: 'Not provided';
        $customerAddress = $booking->customer_address ?: 'Not provided';

        $message = "New booking request received.\n\n"
            ."Service: {$serviceTitle}\n"
            ."Customer: {$customerName}\n"
            ."Customer Phone: {$customerPhone}\n"
            ."Preferred Date: {$bookingDate}\n"
            ."Address: {$customerAddress}\n";

        $this->send($provider->email, 'New service booking request', $message);
    }

    public function notifyCustomerOfApproval(Booking $booking, Provider $provider): void
    {
        $email = $booking->user?->email;

        if (blank($email)) {
            return;
        }

        $serviceTitle = $booking->providerService?->title ?: 'your requested service';
        $bookingDate = $booking->booking_date?->format('d M Y') ?: 'the selected date';

        $message = "Your booking has been approved.\n\n"
            ."Service: {$serviceTitle}\n"
            ."Provider: {$provider->name}\n"
            ."Provider Phone: {$provider->phone}\n"
            ."Date: {$bookingDate}\n";

        $this->send($email, 'Your booking has been approved', $message);
    }

    public function notifyCustomerOfCompletion(Booking $booking, Provider $provider): void
    {
        $email = $booking->user?->email;

        if (blank($email)) {
            return;
        }

        $serviceTitle = $booking->providerService?->title ?: 'your booked service';
        $bookingDate = $booking->booking_date?->format('d M Y') ?: 'the selected date';

        $message = "Your service has been marked as finished.\n\n"
            ."Service: {$serviceTitle}\n"
            ."Provider: {$provider->name}\n"
            ."Service Date: {$bookingDate}\n"
            ."You can now open your bill page and save it as PDF.\n";

        $this->send($email, 'Your service has been completed', $message);
    }

    protected function send(string $to, string $subject, string $message): void
    {
        try {
            Mail::raw($message, function ($mail) use ($to, $subject) {
                $mail->to($to)->subject($subject);
            });
        } catch (Throwable $exception) {
            Log::warning('Booking email notification failed.', [
                'to' => $to,
                'subject' => $subject,
                'error' => $exception->getMessage(),
            ]);
        }
    }
}

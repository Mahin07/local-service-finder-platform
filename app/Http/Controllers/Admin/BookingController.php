<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'service.category', 'provider', 'providerService'])->get();

        return view('admin.managebooking', compact('bookings'));
    }

    // 2️⃣ Show booking details (optional)
    public function show($id)
    {
        $booking = Booking::with(['user', 'provider', 'service.category', 'providerService'])->findOrFail($id);

        return response()->json($booking);
    }

    /* 3️⃣ Update booking status (approve/cancel)
   public function updateStatus(Request $request, $id)
{
    $booking = \App\Models\Booking::findOrFail($id);
    $booking->status = $request->status;
    $booking->save();

    // Wapas usi page par aane ke liye seedha path de do
    return redirect('/admin/managebooking')->with('success', 'Status Updated!');
}
*/
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,approved,finished,cancelled,reject'],
        ]);

        $booking = Booking::findOrFail($id);
        $newStatus = $validated['status'] === 'reject' ? 'cancelled' : $validated['status'];

        $booking->status = $newStatus;
        $booking->finished_at = $newStatus === 'finished' ? now() : null;
        $booking->save();

        return redirect()->route('managebooking.index')->with('success', 'Status updated.');
    }

    // 4️⃣ Delete booking
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->back()->with('success', 'Booking moved to trash.');
    }
}

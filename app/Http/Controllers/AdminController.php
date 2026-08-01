<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }

    /*public function dashboard() {
        // 1. Pending Providers ka count
        $pendingApprovals = \App\Models\Provider::where('status', 'pending')->count();

        // 2. Rejected Bookings ka count (Check karo status 'reject' hi hai na)
        $rejectedCount = \App\Models\Booking::where('status', 'canclled')->count();
        // Purane variables (Jo pehle se chal rahe hain)
        $totalUsers = \App\Models\User::count();
        $totalProviders = \App\Models\Provider::count();
        $totalBookings = \App\Models\Booking::count();
        $pendingApprovals = \App\Models\Provider::where('status', 'pending')->count();
        $recentBookings = \App\Models\Booking::latest()->take(5)->get();

        // 🆕 Naye variables (Jo abhi error de rahe hain)
        $rejectedCount = \App\Models\Booking::where('status', 'cancelled')->count();
        $todayUsers = \App\Models\User::whereDate('created_at', today())->count();
    /* 2. Alerts Logic (Yahan 'reject' ki jagah 'cancelled' likho)
        $pendingApprovals = \App\Models\Provider::where('status', 'pending')->count();
        $rejectedCount = \App\Models\Booking::where('status', 'cancelled')->count(); // Database match fix
        // Chart logic (Comparison chart ke liye)
        $chartStats = [
            ['label' => 'Users', 'count' => $totalUsers],
            ['label' => 'Providers', 'count' => $totalProviders],
            ['label' => 'Bookings', 'count' => $totalBookings],
            ['label' => 'Pending', 'count' => $pendingApprovals],
        ];
        $maxCount = max($totalUsers, $totalProviders, $totalBookings, $pendingApprovals, 1);

        // ✅ Sabko compact mein pass karo
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProviders',
            'totalBookings',
            'pendingApprovals',
            'recentBookings',
            'rejectedCount', // <--- Ye miss ho raha tha
            'todayUsers',
            'chartStats',
            'maxCount'
        ));
    }*/
    public function dashboard()
    {
        // 1. Notification Dropdown ke liye data (Top 5 pending providers)
        $pendingNotifications = \App\Models\Provider::where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // 2. Bell icon par dikhane ke liye dynamic count
        $pendingCount = \App\Models\Provider::where('status', 'pending')->count();

        // 3. Stats Cards ke liye data
        $totalUsers = \App\Models\User::count();
        $totalProviders = \App\Models\Provider::count();
        $totalBookings = \App\Models\Booking::count();

        // Status counts
        $pendingApprovals = $pendingCount; // Alag query ki zaroorat nahi, upar wala count hi kaafi hai
        $rejectedCount = \App\Models\Booking::where('status', 'cancelled')->count();
        $todayUsers = \App\Models\User::whereDate('created_at', today())->count();

        // 4. Recent Activities
        $recentBookings = \App\Models\Booking::latest()->take(5)->get();

        // 5. Chart Logic
        $chartStats = [
            ['label' => 'Users', 'count' => $totalUsers],
            ['label' => 'Providers', 'count' => $totalProviders],
            ['label' => 'Bookings', 'count' => $totalBookings],
            ['label' => 'Pending', 'count' => $pendingApprovals],
        ];
        $maxCount = max($totalUsers, $totalProviders, $totalBookings, $pendingApprovals, 1);

        // ✅ Sab kuch compact karke view mein bhej rahe hain
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProviders',
            'totalBookings',
            'pendingApprovals',
            'recentBookings',
            'rejectedCount',
            'todayUsers',
            'chartStats',
            'maxCount',
            'pendingNotifications', // Dropdown list ke liye
            'pendingCount'           // Bell badge ke liye
        ));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}

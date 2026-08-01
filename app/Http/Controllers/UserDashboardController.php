<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserDashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = Auth::user();
        $selectedCity = trim((string) $request->query('location', ''));
        $selectedService = trim((string) $request->query('service', ''));

        if ($selectedCity === '') {
            $selectedCity = $this->guessCityFromAddress((string) ($user->address ?? ''));
        }

        return view('user.dashboard', [
            'categories' => Category::query()
                ->where('status', 1)
                ->orderBy('name')
                ->select(['id', 'name', 'description'])
                ->get(),
            'providers' => Provider::query()
                ->where('status', 'approved')
                ->latest()
                ->select(['id', 'name', 'service', 'experience', 'city', 'phone', 'image'])
                ->get(),
            'selectedCity' => $selectedCity,
            'selectedService' => $selectedService,
        ]);
    }

    private function guessCityFromAddress(string $address): string
    {
        $address = trim($address);

        if ($address === '') {
            return '';
        }

        $parts = array_values(array_filter(array_map('trim', explode(',', $address))));

        if (count($parts) >= 2) {
            return $parts[count($parts) - 2];
        }

        return $parts[0] ?? $address;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProviderService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserServicesController extends Controller
{
    public function __invoke(Request $request): View
    {
        $location = trim((string) $request->query('location', ''));
        $service = trim((string) $request->query('service', ''));

        $servicesQuery = ProviderService::query()
            ->select([
                'id',
                'provider_id',
                'title',
                'category',
                'description',
                'price',
                'city',
                'service_area',
                'availability',
                'image',
            ])
            ->with('provider:id,name,city,image,phone')
            ->where('is_active', true)
            ->whereHas('provider', function ($query) {
                $query->where('status', 'approved');
            })
            ->latest();

        if ($service !== '') {
            $servicesQuery->where(function ($query) use ($service) {
                $query->where('category', 'like', '%'.$service.'%')
                    ->orWhere('title', 'like', '%'.$service.'%')
                    ->orWhere('description', 'like', '%'.$service.'%');
            });
        }

        if ($location !== '') {
            $servicesQuery->where(function ($query) use ($location) {
                $query->where('city', 'like', '%'.$location.'%')
                    ->orWhere('service_area', 'like', '%'.$location.'%')
                    ->orWhereHas('provider', function ($providerQuery) use ($location) {
                        $providerQuery->where('city', 'like', '%'.$location.'%');
                    });
            });
        }

        $services = $servicesQuery->get();

        $providers = $services->map(function (ProviderService $serviceItem) {
            return [
                'id' => $serviceItem->id,
                'name' => $serviceItem->provider?->name ?: 'Approved Provider',
                'category' => $serviceItem->category,
                'rating' => '4.9',
                'reviews' => random_int(48, 320),
                'price' => $serviceItem->price ? '$'.number_format((float) $serviceItem->price, 0) : 'Price on request',
                'distance' => $serviceItem->city,
                'response' => $serviceItem->availability ?: 'Same day',
                'tags' => array_values(array_filter([
                    $serviceItem->service_area,
                    $serviceItem->provider?->city,
                ])),
                'image' => $serviceItem->image
                    ? asset($serviceItem->image)
                    : ($serviceItem->provider?->image ? asset($serviceItem->provider->image) : asset('img/WhatsApp Image 2026-03-28 at 7.10.26 PM.jpeg')),
                'phone' => $serviceItem->provider?->phone,
                'description' => $serviceItem->description,
                'booking_url' => route('services.booking.create', $serviceItem),
            ];
        })->values();

        $categories = Category::query()
            ->where('status', 1)
            ->orderBy('name')
            ->pluck('name')
            ->values();

        return view('user.show_services', [
            'directoryProviders' => $providers,
            'directoryCategories' => $categories,
            'selectedLocation' => $location,
            'selectedService' => $service,
            'activeProsCount' => $providers->count(),
        ]);
    }
}

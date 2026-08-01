<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return view('admin.manageservice', [
            'services' => Service::with('category')->latest()->get(),
            'categories' => Category::where('status', 1)->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric', 'min:0'],
        ]);

        Service::create($validated);

        return redirect()->route('manageservice.index')->with('success', 'Service added successfully.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric', 'min:0'],
        ]);

        $service = Service::findOrFail($id);
        $service->update($validated);

        return redirect()->route('manageservice.index')->with('success', 'Service updated successfully.');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        if (Booking::where('service_id', $service->id)->exists()) {
            return redirect()->back()->withErrors([
                'service' => 'This service is already linked to bookings and cannot be deleted.',
            ]);
        }

        $service->delete();

        return redirect()->back()->with('success', 'Service deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProviderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProviderServiceController extends Controller
{
    public function index(): View
    {
        return view('admin.provider_service', [
            'services' => ProviderService::query()->latest()->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        ProviderService::create($this->validatedData($request));

        return back()->with('success', 'Service added successfully.');
    }

    public function update(Request $request, ProviderService $providerService): RedirectResponse
    {
        $providerService->update($this->validatedData($request));

        return back()->with('success', 'Service updated successfully.');
    }

    public function destroy(ProviderService $providerService): RedirectResponse
    {
        $providerService->delete();

        return back()->with('success', 'Service moved to trash.');
    }

    /** @return array<string, mixed> */
    private function validatedData(Request $request): array
    {
        return $request->validate([
            'provider_id' => ['required', 'exists:providers,id'],
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'city' => ['required', 'string', 'max:120'],
            'service_area' => ['nullable', 'string', 'max:255'],
            'availability' => ['nullable', 'string', 'max:255'],
        ]);
    }
}

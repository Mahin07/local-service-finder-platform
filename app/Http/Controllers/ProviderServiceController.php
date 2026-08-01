<?php

namespace App\Http\Controllers;

use App\Models\ProviderService;
use App\Services\PublicImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ProviderServiceController extends Controller
{
    public function __construct(private readonly PublicImageUploadService $imageUploader) {}

    public function index(): View
    {
        $provider = Auth::guard('provider')->user();
        $this->ensureApprovedProvider($provider);

        return view('provider.services.index', [
            'provider' => $provider,
            'services' => $provider->providerServices()->latest()->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $provider = Auth::guard('provider')->user();
        $this->ensureApprovedProvider($provider);

        $validated = $this->validateService($request);

        $provider->providerServices()->create([
            ...$validated,
            'image' => $request->hasFile('image')
                ? $this->imageUploader->store($request->file('image'), 'uploads/provider-services')
                : null,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('provider.services.index')
            ->with('success', 'Service added successfully and is now available for users.');
    }

    public function update(Request $request, ProviderService $providerService): RedirectResponse
    {
        $provider = Auth::guard('provider')->user();
        $this->ensureApprovedProvider($provider);
        Gate::forUser($provider)->authorize('manage', $providerService);

        $validated = $this->validateService($request);
        $imagePath = $providerService->image;

        if ($request->hasFile('image')) {
            $imagePath = $this->imageUploader->store($request->file('image'), 'uploads/provider-services');
        }

        $providerService->update([
            ...$validated,
            'image' => $imagePath,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('provider.services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(ProviderService $providerService): RedirectResponse
    {
        $provider = Auth::guard('provider')->user();
        $this->ensureApprovedProvider($provider);
        Gate::forUser($provider)->authorize('manage', $providerService);

        $providerService->delete();

        return redirect()
            ->route('provider.services.index')
            ->with('success', 'Service removed successfully.');
    }

    private function validateService(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'price' => 'nullable|numeric|min:0',
            'city' => 'required|string|max:120',
            'service_area' => 'nullable|string|max:255',
            'availability' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
    }

    private function ensureApprovedProvider($provider): void
    {
        abort_unless($provider && $provider->status === 'approved', 403, 'Only approved providers can manage services.');
    }
}

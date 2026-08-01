<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request; // <--- YEH LINE ADD KAREIN
use Illuminate\Validation\Rule;

class ProviderController extends Controller
{
    public function index()
    {
        return view('admin.manageprovider', [
            'providers' => Provider::query()->latest()->paginate(8),
            'approvedCount' => Provider::where('status', 'approved')->count(),
            'pendingCount' => Provider::where('status', 'pending')->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $provider = Provider::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('providers', 'email')->ignore($provider->id)],
            'city' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:30'],
            'experience' => ['nullable', 'string', 'max:120'],
            'status' => ['required', 'in:pending,approved,rejected'],
        ]);

        $provider->update($validated);

        return back()->with('success', 'Provider details updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $provider = Provider::findOrFail($id);
        $provider->delete();

        return redirect()->back()->with('success', 'Provider deleted.');
    }
}

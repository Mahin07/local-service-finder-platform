<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.managecategories', [
            // Kept as "services" for the existing view contract.
            'services' => Category::query()->latest()->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Category::create($this->validatedData($request));

        return redirect()->route('managecategories.index')->with('success', 'Category added successfully.');
    }

    public function update(Request $request, Category $managecategory): RedirectResponse
    {
        $managecategory->update($this->validatedData($request, $managecategory->status));

        return redirect()->route('managecategories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $managecategory): RedirectResponse
    {
        $managecategory->delete();

        return back()->with('success', 'Category removed successfully.');
    }

    /** @return array{name: string, description: string|null, status: int|string|bool} */
    private function validatedData(Request $request, int|bool $defaultStatus = true): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'boolean'],
        ]);

        $validated['status'] = $validated['status'] ?? $defaultStatus;

        return $validated;
    }
}

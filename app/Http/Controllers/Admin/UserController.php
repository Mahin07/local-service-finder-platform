<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        return view('admin.manageuser', [
            'users' => User::query()->latest()->get(),
        ]);
    }

    public function update(Request $request, User $manageuser): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($manageuser)],
            'address' => ['nullable', 'string', 'max:1000'],
        ]);

        $manageuser->update($validated);

        return back()->with('success', 'User updated successfully.');
    }

    public function destroy(User $manageuser): RedirectResponse
    {
        $manageuser->update(['status' => 'blocked']);

        return back()->with('success', 'User blocked successfully.');
    }
}

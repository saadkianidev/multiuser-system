<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $admins = User::role('admin')->with('ownedCompanies')->get();

        return view('admins.index', compact('admins'));
    }

    public function create(): View
    {
        return view('admins.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ])->validate();

        $admin = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'email_verified_at' => now(),
        ]);

        $admin->assignRole('admin');

        return redirect()->route('super_admin.admins.index')->with('status', 'Admin created.');
    }

    public function edit(User $admin): View
    {
        abort_unless($admin->hasRole('admin'), 404);

        return view('admins.edit', compact('admin'));
    }

    public function update(Request $request, User $admin): RedirectResponse
    {
        abort_unless($admin->hasRole('admin'), 404);

        $validated = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'password' => 'nullable|min:8',
        ])->validate();

        $admin->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? Hash::make($validated['password']) : $admin->password,
        ]);

        return redirect()->route('super_admin.admins.index')->with('status', 'Admin updated.');
    }

    public function destroy(User $admin): RedirectResponse
    {
        abort_unless($admin->hasRole('admin'), 404);

        $admin->delete();

        return redirect()->route('super_admin.admins.index')->with('status', 'Admin removed.');
    }
}
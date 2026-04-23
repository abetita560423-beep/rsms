<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function index(): View
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', [
            'users' => $users,
            'roles' => User::ROLES,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', Rule::in(User::ROLES)],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return back()->with('status', 'User created successfully.');
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        // Prevent admin from changing their own role to something else if they are the only admin
        // But for simplicity, we'll just allow it unless it's the current user.
        if ($user->id === auth()->id()) {
            return back()->withErrors(['role' => 'You cannot change your own role.']);
        }

        $validated = $request->validate([
            'role' => ['required', Rule::in(User::ROLES)],
        ]);

        $user->update(['role' => $validated['role']]);

        return back()->with('status', 'User role updated successfully.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'You cannot delete yourself.']);
        }

        $user->delete();

        return back()->with('status', 'User deleted successfully.');
    }
}

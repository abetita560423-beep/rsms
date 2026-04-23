<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserManagementController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('search')->toString();

        $users = User::query()
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($nested) use ($search): void {
                    $nested->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('role', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.users.index', [
            'users' => $users,
            'search' => $search,
            'roles' => User::ALLOWED_ROLES,
        ]);
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', [
            'userModel' => $user,
            'roles' => User::ALLOWED_ROLES,
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'role' => ['required', Rule::in(User::ALLOWED_ROLES)],
        ]);

        if ($user->id === $request->user()->id && $validated['role'] !== User::ROLE_ADMIN && $this->isLastAdmin($user)) {
            return back()->withErrors([
                'role' => 'You cannot remove admin role from the last admin account.',
            ]);
        }

        $user->update($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('status', 'User updated successfully.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($user->id === $request->user()->id) {
            return back()->withErrors([
                'user' => 'You cannot delete your own account.',
            ]);
        }

        if ($user->role === User::ROLE_ADMIN && $this->isLastAdmin($user)) {
            return back()->withErrors([
                'user' => 'You cannot delete the last admin account.',
            ]);
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('status', 'User deleted successfully.');
    }

    private function isLastAdmin(User $user): bool
    {
        return $user->role === User::ROLE_ADMIN
            && User::where('role', User::ROLE_ADMIN)->count() <= 1;
    }
}

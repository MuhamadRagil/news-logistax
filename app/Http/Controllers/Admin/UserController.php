<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users.manage');
    }

    public function index(): View
    {
        $users = User::query()
            ->with('roles')
            ->latest()
            ->paginate(20);

        return view('admin.users.index', [
            'users' => $users,
            'hasIsActiveColumn' => $this->hasIsActiveColumn(),
            'hasLastLoginColumn' => $this->hasLastLoginColumn(),
        ]);
    }

    public function create(): View
    {
        return view('admin.users.create', [
            'user' => new User(['is_active' => true]),
            'roles' => $this->roles(),
            'hasIsActiveColumn' => $this->hasIsActiveColumn(),
        ]);
    }

    public function store(UserStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        DB::transaction(function () use ($data): void {
            $userData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ];

            if ($this->hasIsActiveColumn()) {
                $userData['is_active'] = (bool) ($data['is_active'] ?? false);
            }

            $user = User::create($userData);
            $user->assignRole($data['role']);
        });

        return redirect()->route('admin.users.index')->with('success', 'User created.');
    }

    public function edit(User $user): View
    {
        $user->load('roles');

        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $this->roles(),
            'hasIsActiveColumn' => $this->hasIsActiveColumn(),
        ]);
    }

    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();

        DB::transaction(function () use ($data, $user): void {
            $userData = [
                'name' => $data['name'],
                'email' => $data['email'],
            ];

            if (! empty($data['password'])) {
                $userData['password'] = Hash::make($data['password']);
            }

            if ($this->hasIsActiveColumn()) {
                $userData['is_active'] = (bool) ($data['is_active'] ?? false);
            }

            $user->update($userData);
            $user->syncRoles([$data['role']]);
        });

        return redirect()->route('admin.users.index')->with('success', 'User updated.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ((int) $user->getKey() === (int) auth()->id()) {
            return back()->withErrors(['user' => 'You cannot delete your own account.']);
        }

        if ($user->hasRole('Super Admin') && $this->superAdminCount() <= 1) {
            return back()->withErrors(['user' => 'The last Super Admin user cannot be deleted.']);
        }

        DB::transaction(function () use ($user): void {
            $user->syncRoles([]);
            $user->delete();
        });

        return redirect()->route('admin.users.index')->with('success', 'User deleted.');
    }

    private function roles()
    {
        return Role::query()
            ->where('guard_name', 'web')
            ->orderBy('name')
            ->get();
    }

    private function superAdminCount(): int
    {
        return User::role('Super Admin')->count();
    }

    private function hasIsActiveColumn(): bool
    {
        return Schema::hasColumn('users', 'is_active');
    }

    private function hasLastLoginColumn(): bool
    {
        return Schema::hasColumn('users', 'last_login_at');
    }
}

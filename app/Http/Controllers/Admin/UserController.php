<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRoleUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users.manage');
    }

    public function index(): View
    {
        $users = User::latest()->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user): View
    {
        $roles = ['Super Admin', 'Editor', 'Author'];

        return view('admin.users.form', compact('user', 'roles'));
    }

    public function update(UserRoleUpdateRequest $request, User $user): RedirectResponse
    {
        $user->syncRoles([$request->string('role')]);

        return back()->with('success', 'User role updated.');
    }
}

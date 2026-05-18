@extends('layouts.admin')

@section('title', 'Users')
@section('page_title', 'Users & Roles')

@section('content')
<div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h3 class="text-lg font-semibold text-slate-900">Manage CMS Users</h3>
        <p class="mt-1 text-sm text-slate-500">Create users, update profiles, assign roles, and keep admin access secure.</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="inline-flex items-center justify-center rounded-lg bg-[#0F4C6C] px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-[#0d425d]">
        Add User
    </a>
</div>

<div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full min-w-[900px] text-sm">
            <thead class="bg-slate-50 text-slate-600">
                <tr>
                    <th class="px-5 py-3 text-left font-medium">Name</th>
                    <th class="px-5 py-3 text-left font-medium">Email</th>
                    <th class="px-5 py-3 text-left font-medium">Role</th>
                    <th class="px-5 py-3 text-left font-medium">Status</th>
                    <th class="px-5 py-3 text-left font-medium">Last Login</th>
                    <th class="px-5 py-3 text-right font-medium">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="border-t border-slate-200 hover:bg-slate-50/70">
                        <td class="px-5 py-4">
                            <div class="font-medium text-slate-900">{{ $user->name }}</div>
                            <div class="text-xs text-slate-500">ID: {{ $user->id }}</div>
                        </td>
                        <td class="px-5 py-4 text-slate-600">{{ $user->email }}</td>
                        <td class="px-5 py-4">
                            <div class="flex flex-wrap gap-2">
                                @forelse($user->roles as $role)
                                    <span class="rounded-full bg-[#E6F4FA] px-2.5 py-1 text-xs font-medium text-[#0F4C6C]">
                                        {{ $role->name }}
                                    </span>
                                @empty
                                    <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-500">No role</span>
                                @endforelse
                            </div>
                        </td>
                        <td class="px-5 py-4">
                            @if($hasIsActiveColumn)
                                @if($user->is_active)
                                    <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 ring-1 ring-emerald-200">Active</span>
                                @else
                                    <span class="rounded-full bg-rose-50 px-2.5 py-1 text-xs font-medium text-rose-700 ring-1 ring-rose-200">Inactive</span>
                                @endif
                            @else
                                <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-500">N/A</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-slate-600">
                            @if($hasLastLoginColumn && $user->last_login_at)
                                <span title="{{ $user->last_login_at->toDayDateTimeString() }}">{{ $user->last_login_at->diffForHumans() }}</span>
                            @else
                                <span class="text-slate-400">Never</span>
                            @endif
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex flex-wrap items-center justify-end gap-3">
                                <a href="{{ route('admin.users.edit', $user) }}" class="font-medium text-blue-700 hover:text-blue-900">Edit</a>
                                <a href="{{ route('admin.users.edit', $user) }}#role-card" class="font-medium text-[#0F4C6C] hover:text-[#0d425d]">Edit Role</a>
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Delete this user? This action cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium text-rose-600 hover:text-rose-800">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-8 text-center text-slate-500">
                            No users found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $users->links() }}
</div>
@endsection

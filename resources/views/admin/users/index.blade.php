@extends('layouts.admin')

@section('title', 'Users')
@section('page_title', 'Users & Roles')

@section('content')
<div class="rounded-xl bg-white border border-slate-200 overflow-hidden shadow-sm">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-600">
            <tr>
                <th class="px-5 py-3 text-left font-medium">Name</th>
                <th class="px-5 py-3 text-left font-medium">Email</th>
                <th class="px-5 py-3 text-left font-medium">Role</th>
                <th class="px-5 py-3 text-left font-medium">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr class="border-t border-slate-200 hover:bg-slate-50/70">
                    <td class="px-5 py-3 font-medium">{{ $user->name }}</td>
                    <td class="px-5 py-3 text-slate-600">{{ $user->email }}</td>
                    <td class="px-5 py-3">{{ $user->getRoleNames()->join(', ') }}</td>
                    <td class="px-5 py-3">
                        <a class="text-blue-700 hover:text-blue-900" href="{{ route('admin.users.edit', $user) }}">
                            Edit Role
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-5 py-6 text-center text-slate-500">
                        No users found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $users->links() }}
</div>
@endsection
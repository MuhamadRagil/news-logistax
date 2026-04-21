@extends('layouts.admin')

@section('title', 'Edit User Role')
@section('page_title', 'Edit User Role')

@section('content')
<form method="POST" action="{{ route('admin.users.update', $user) }}" class="max-w-xl rounded-xl bg-white border border-slate-200 p-6 space-y-4 shadow-sm">
    @csrf
    @method('PUT')

    <div>
        <p class="text-xs uppercase tracking-[0.16em] text-slate-500">User</p>
        <p class="mt-1 font-semibold text-slate-900">{{ $user->name }}</p>
        <p class="text-sm text-slate-600">{{ $user->email }}</p>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Role</label>
        <select name="role" class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40">
            @foreach($roles as $role)
                <option value="{{ $role }}" @selected($user->hasRole($role))>{{ $role }}</option>
            @endforeach
        </select>
    </div>

    <div class="flex gap-3 pt-2">
        <button class="px-4 py-2 rounded-lg bg-[#0F4C6C] text-white hover:bg-[#0d425d] transition-colors">Update Role</button>
        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 rounded-lg border border-slate-300 bg-white hover:bg-slate-50 transition-colors">Back</a>
    </div>
</form>
@endsection
@extends('layouts.admin')
@section('title', 'Edit User Role')
@section('page_title', 'Edit User Role')
@section('content')
<form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-4 max-w-lg">
    @csrf @method('PUT')
    <p class="font-semibold">{{ $user->name }} ({{ $user->email }})</p>
    <select name="role" class="border rounded px-3 py-2 w-full">
        @foreach($roles as $role)
            <option value="{{ $role }}" @selected($user->hasRole($role))>{{ $role }}</option>
        @endforeach
    </select>
    <button class="px-4 py-2 bg-blue-600 text-white rounded">Update Role</button>
</form>
@endsection

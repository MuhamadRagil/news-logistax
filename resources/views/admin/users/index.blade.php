@extends('layouts.admin')
@section('title', 'Users')
@section('page_title', 'Users')
@section('content')
<table class="w-full bg-white border rounded text-sm">
    @foreach($users as $user)
    <tr class="border-b">
        <td class="p-3">{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->getRoleNames()->join(', ') }}</td>
        <td><a class="text-blue-700" href="{{ route('admin.users.edit', $user) }}">Edit Role</a></td>
    </tr>
    @endforeach
</table>
<div class="mt-4">{{ $users->links() }}</div>
@endsection

@extends('layouts.admin')

@section('title', 'Edit User')
@section('page_title', 'Edit User')

@section('content')
@include('admin.users.form', [
    'action' => route('admin.users.update', $user),
    'method' => 'PUT',
    'submitLabel' => 'Update User',
])
@endsection

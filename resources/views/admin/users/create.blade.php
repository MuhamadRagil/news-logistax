@extends('layouts.admin')

@section('title', 'Add User')
@section('page_title', 'Add User')

@section('content')
@include('admin.users.form', [
    'action' => route('admin.users.store'),
    'method' => 'POST',
    'submitLabel' => 'Create User',
])
@endsection

@extends('layouts.admin')
@section('title', 'General Settings')
@section('page_title', 'General Settings')
@section('content')
<form method="POST" action="{{ route('admin.settings.general.update') }}" class="space-y-4 max-w-xl">
    @csrf @method('PUT')
    <input name="site_name" value="{{ old('site_name', data_get($general->value, 'site_name')) }}" class="w-full border rounded px-3 py-2" placeholder="Site Name">
    <input name="site_logo" value="{{ old('site_logo', data_get($general->value, 'site_logo')) }}" class="w-full border rounded px-3 py-2" placeholder="Site Logo Path">
    <input name="footer_text" value="{{ old('footer_text', data_get($general->value, 'footer_text')) }}" class="w-full border rounded px-3 py-2" placeholder="Footer Text">
    <button class="px-4 py-2 bg-blue-600 text-white rounded">Save Settings</button>
</form>
@endsection

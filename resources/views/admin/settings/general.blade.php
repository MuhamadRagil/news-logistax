@extends('layouts.admin')

@section('title', 'General Settings')
@section('page_title', 'General Settings')

@section('content')
<form method="POST" action="{{ route('admin.settings.general.update') }}" class="max-w-2xl rounded-xl bg-white border border-slate-200 p-6 space-y-4 shadow-sm">
    @csrf
    @method('PUT')

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">
            Site Name
        </label>
        <input
            name="site_name"
            value="{{ old('site_name', data_get($general->value, 'site_name')) }}"
            class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
        >
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">
            Site Logo Path
        </label>
        <input
            name="site_logo"
            value="{{ old('site_logo', data_get($general->value, 'site_logo')) }}"
            class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
        >
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">
            Footer Text
        </label>
        <input
            name="footer_text"
            value="{{ old('footer_text', data_get($general->value, 'footer_text')) }}"
            class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
        >
    </div>

    <div class="pt-2">
        <button class="px-4 py-2 rounded-lg bg-[#0F4C6C] text-white hover:bg-[#0d425d] transition-colors">
            Save Settings
        </button>
    </div>
</form>
@endsection
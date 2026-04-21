@extends('layouts.admin')

@section('title', $tag->exists ? 'Edit Tag' : 'Create Tag')
@section('page_title', $tag->exists ? 'Edit Tag' : 'Create Tag')

@section('content')
<form method="POST" action="{{ $tag->exists ? route('admin.tags.update', $tag) : route('admin.tags.store') }}" class="max-w-2xl rounded-xl bg-white border border-slate-200 p-6 space-y-4 shadow-sm">
    @csrf
    @if($tag->exists)
        @method('PUT')
    @endif

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Name</label>
        <input
            name="name"
            value="{{ old('name', $tag->name) }}"
            class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
            required
        >
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Slug</label>
        <input
            name="slug"
            value="{{ old('slug', $tag->slug) }}"
            class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
            required
        >
    </div>

    <div class="flex gap-3 pt-2">
        <button class="px-4 py-2 rounded-lg bg-[#0F4C6C] text-white hover:bg-[#0d425d] transition-colors">Save</button>
        <a href="{{ route('admin.tags.index') }}" class="px-4 py-2 rounded-lg border border-slate-300 bg-white hover:bg-slate-50 transition-colors">Back</a>
    </div>
</form>
@endsection
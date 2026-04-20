@extends('layouts.admin')
@section('title', $tag->exists ? 'Edit Tag' : 'Create Tag')
@section('page_title', $tag->exists ? 'Edit Tag' : 'Create Tag')

@section('content')
<form method="POST" action="{{ $tag->exists ? route('admin.tags.update', $tag) : route('admin.tags.store') }}" class="max-w-2xl bg-white border border-slate-200 p-6 space-y-4">
    @csrf
    @if($tag->exists) @method('PUT') @endif

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Name</label>
        <input name="name" value="{{ old('name', $tag->name) }}" class="w-full border border-slate-300 px-3 py-2" required>
    </div>
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Slug</label>
        <input name="slug" value="{{ old('slug', $tag->slug) }}" class="w-full border border-slate-300 px-3 py-2" required>
    </div>

    <div class="flex gap-3 pt-2">
        <button class="px-4 py-2 bg-blue-700 text-white">Save</button>
        <a href="{{ route('admin.tags.index') }}" class="px-4 py-2 border border-slate-300 bg-white">Back</a>
    </div>
</form>
@endsection

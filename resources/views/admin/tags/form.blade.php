@extends('layouts.admin')
@section('title', $tag->exists ? 'Edit Tag' : 'New Tag')
@section('page_title', $tag->exists ? 'Edit Tag' : 'New Tag')
@section('content')
<form method="POST" action="{{ $tag->exists ? route('admin.tags.update', $tag) : route('admin.tags.store') }}" class="space-y-4 max-w-xl">
    @csrf @if($tag->exists) @method('PUT') @endif
    <input name="name" value="{{ old('name', $tag->name) }}" class="w-full border rounded px-3 py-2" placeholder="Name">
    <input name="slug" value="{{ old('slug', $tag->slug) }}" class="w-full border rounded px-3 py-2" placeholder="Slug">
    <button class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
</form>
@endsection

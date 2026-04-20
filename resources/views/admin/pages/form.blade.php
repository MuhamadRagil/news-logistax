@extends('layouts.admin')
@section('title', 'Edit Page')
@section('page_title', 'Edit Page')
@section('content')
<form method="POST" action="{{ route('admin.pages.update', $page) }}" class="space-y-4">
    @csrf @method('PUT')
    <input name="title" value="{{ old('title', $page->title) }}" class="w-full border rounded px-3 py-2">
    <textarea name="body" rows="12" class="w-full border rounded px-3 py-2">{{ old('body', $page->body) }}</textarea>
    <select name="status" class="border rounded px-3 py-2">
        <option value="draft" @selected(old('status', $page->status) === 'draft')>draft</option>
        <option value="published" @selected(old('status', $page->status) === 'published')>published</option>
    </select>
    <input name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" class="w-full border rounded px-3 py-2" placeholder="Meta title">
    <input name="meta_description" value="{{ old('meta_description', $page->meta_description) }}" class="w-full border rounded px-3 py-2" placeholder="Meta description">
    <button class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
</form>
@endsection

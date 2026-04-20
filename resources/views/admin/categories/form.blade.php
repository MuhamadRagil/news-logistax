@extends('layouts.admin')
@section('title', $category->exists ? 'Edit Category' : 'New Category')
@section('page_title', $category->exists ? 'Edit Category' : 'New Category')
@section('content')
<form method="POST" action="{{ $category->exists ? route('admin.categories.update', $category) : route('admin.categories.store') }}" class="space-y-4 max-w-xl">
    @csrf @if($category->exists) @method('PUT') @endif
    <input name="name" value="{{ old('name', $category->name) }}" class="w-full border rounded px-3 py-2" placeholder="Name">
    <input name="slug" value="{{ old('slug', $category->slug) }}" class="w-full border rounded px-3 py-2" placeholder="Slug">
    <textarea name="description" class="w-full border rounded px-3 py-2" placeholder="Description">{{ old('description', $category->description) }}</textarea>
    <label><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $category->is_active ?? true))> Active</label>
    <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order ?? 0) }}" class="w-full border rounded px-3 py-2" placeholder="Sort order">
    <button class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
</form>
@endsection

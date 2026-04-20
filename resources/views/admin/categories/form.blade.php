@extends('layouts.admin')
@section('title', $category->exists ? 'Edit Category' : 'Create Category')
@section('page_title', $category->exists ? 'Edit Category' : 'Create Category')

@section('content')
<form method="POST" action="{{ $category->exists ? route('admin.categories.update', $category) : route('admin.categories.store') }}" class="max-w-2xl bg-white border border-slate-200 p-6 space-y-4">
    @csrf
    @if($category->exists) @method('PUT') @endif

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Name</label>
        <input name="name" value="{{ old('name', $category->name) }}" class="w-full border border-slate-300 px-3 py-2" required>
    </div>
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Slug</label>
        <input name="slug" value="{{ old('slug', $category->slug) }}" class="w-full border border-slate-300 px-3 py-2" required>
    </div>
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Description</label>
        <textarea name="description" rows="4" class="w-full border border-slate-300 px-3 py-2">{{ old('description', $category->description) }}</textarea>
    </div>
    <div class="grid sm:grid-cols-2 gap-4 items-center">
        <label class="inline-flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $category->is_active ?? true))> Active category</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order ?? 0) }}" class="border border-slate-300 px-3 py-2" placeholder="Sort order">
    </div>

    <div class="flex gap-3 pt-2">
        <button class="px-4 py-2 bg-blue-700 text-white">Save</button>
        <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 border border-slate-300 bg-white">Back</a>
    </div>
</form>
@endsection

@extends('layouts.admin')

@section('title', 'Edit Page')
@section('page_title', 'Edit Page: ' . $page->title)

@section('content')
<form method="POST" action="{{ route('admin.pages.update', $page) }}" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="bg-white border border-slate-200 p-6 space-y-4">
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Title</label>
            <input
                name="title"
                value="{{ old('title', $page->title) }}"
                class="w-full border border-slate-300 px-3 py-2"
            >
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Body</label>
            <textarea
                name="body"
                rows="14"
                class="w-full border border-slate-300 px-3 py-2"
            >{{ old('body', $page->body) }}</textarea>
        </div>

        <div class="grid sm:grid-cols-3 gap-4">
            <select name="status" class="border border-slate-300 px-3 py-2">
                <option value="draft" @selected(old('status', $page->status) === 'draft')>Draft</option>
                <option value="published" @selected(old('status', $page->status) === 'published')>Published</option>
            </select>

            <input
                name="meta_title"
                value="{{ old('meta_title', $page->meta_title) }}"
                class="border border-slate-300 px-3 py-2"
                placeholder="Meta title"
            >

            <input
                name="meta_description"
                value="{{ old('meta_description', $page->meta_description) }}"
                class="border border-slate-300 px-3 py-2"
                placeholder="Meta description"
            >
        </div>
    </div>

    <div class="flex gap-3">
        <button class="px-4 py-2 bg-blue-700 text-white">Save</button>
        <a href="{{ route('admin.pages.index') }}" class="px-4 py-2 border border-slate-300 bg-white">Back</a>
    </div>
</form>
@endsection
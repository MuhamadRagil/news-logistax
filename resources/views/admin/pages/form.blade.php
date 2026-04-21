@extends('layouts.admin')

@section('title', 'Edit Page')
@section('page_title', 'Edit Page: ' . $page->title)

@section('content')
<form method="POST" action="{{ route('admin.pages.update', $page) }}" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="rounded-xl bg-white border border-slate-200 p-6 space-y-4 shadow-sm">
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Title</label>
            <input
                name="title"
                value="{{ old('title', $page->title) }}"
                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
            >
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Body</label>
            <textarea
                name="body"
                rows="14"
                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
            >{{ old('body', $page->body) }}</textarea>
        </div>

        <div class="grid sm:grid-cols-3 gap-4">
            <select name="status" class="rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40">
                <option value="draft" @selected(old('status', $page->status) === 'draft')>Draft</option>
                <option value="published" @selected(old('status', $page->status) === 'published')>Published</option>
            </select>

            <input
                name="meta_title"
                value="{{ old('meta_title', $page->meta_title) }}"
                class="rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
                placeholder="Meta title"
            >

            <input
                name="meta_description"
                value="{{ old('meta_description', $page->meta_description) }}"
                class="rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
                placeholder="Meta description"
            >
        </div>
    </div>

    <div class="flex gap-3">
        <button class="px-4 py-2 rounded-lg bg-[#0F4C6C] text-white hover:bg-[#0d425d] transition-colors">Save</button>
        <a href="{{ route('admin.pages.index') }}" class="px-4 py-2 rounded-lg border border-slate-300 bg-white hover:bg-slate-50 transition-colors">Back</a>
    </div>
</form>
@endsection
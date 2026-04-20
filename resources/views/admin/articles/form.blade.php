@extends('layouts.admin')

@section('title', $article->exists ? 'Edit Article' : 'New Article')
@section('page_title', $article->exists ? 'Edit Article' : 'New Article')

@section('content')
<form method="POST" action="{{ $article->exists ? route('admin.articles.update', $article) : route('admin.articles.store') }}" class="space-y-6">
    @csrf
    @if($article->exists) @method('PUT') @endif

    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm">Title</label>
            <input name="title" value="{{ old('title', $article->title) }}" class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-sm">Slug</label>
            <input name="slug" value="{{ old('slug', $article->slug) }}" class="w-full border rounded px-3 py-2">
        </div>
    </div>

    <div>
        <label class="block text-sm">Subtitle</label>
        <input name="subtitle" value="{{ old('subtitle', $article->subtitle) }}" class="w-full border rounded px-3 py-2">
    </div>

    <div>
        <label class="block text-sm">Excerpt</label>
        <textarea name="excerpt" rows="3" class="w-full border rounded px-3 py-2">{{ old('excerpt', $article->excerpt) }}</textarea>
    </div>

    <div>
        <label class="block text-sm">Body</label>
        <textarea name="body" rows="10" class="w-full border rounded px-3 py-2">{{ old('body', $article->body) }}</textarea>
    </div>

    <div class="grid md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm">Content Type</label>
            <select name="content_type" class="w-full border rounded px-3 py-2">
                @foreach(['news','announcement','opinion','press_release'] as $type)
                    <option value="{{ $type }}" @selected(old('content_type', $article->content_type) === $type)>{{ $type }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm">Category</label>
            <select name="category_id" class="w-full border rounded px-3 py-2">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected((int)old('category_id', $article->category_id) === $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm">Featured Image</label>
            <select name="featured_image_id" class="w-full border rounded px-3 py-2">
                <option value="">None</option>
                @foreach($media as $item)
                    <option value="{{ $item->id }}" @selected((int)old('featured_image_id', $article->featured_image_id) === $item->id)>{{ $item->filename }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div>
        <label class="block text-sm">Tags</label>
        <select name="tags[]" multiple class="w-full border rounded px-3 py-2 h-32">
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}" @selected(in_array($tag->id, old('tags', $selectedTags)))>{{ $tag->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="grid md:grid-cols-2 gap-4">
        <label class="inline-flex items-center gap-2"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $article->is_featured))> Featured</label>
        <label class="inline-flex items-center gap-2"><input type="checkbox" name="is_indexable" value="1" @checked(old('is_indexable', $article->is_indexable ?? true))> Indexable</label>
    </div>

    <div class="grid md:grid-cols-2 gap-4">
        <div><label class="block text-sm">Meta Title</label><input name="meta_title" value="{{ old('meta_title', $article->meta_title) }}" class="w-full border rounded px-3 py-2"></div>
        <div><label class="block text-sm">Meta Description</label><input name="meta_description" value="{{ old('meta_description', $article->meta_description) }}" class="w-full border rounded px-3 py-2"></div>
        <div><label class="block text-sm">OG Title</label><input name="og_title" value="{{ old('og_title', $article->og_title) }}" class="w-full border rounded px-3 py-2"></div>
        <div><label class="block text-sm">OG Description</label><input name="og_description" value="{{ old('og_description', $article->og_description) }}" class="w-full border rounded px-3 py-2"></div>
        <div><label class="block text-sm">Canonical URL</label><input name="canonical_url" value="{{ old('canonical_url', $article->canonical_url) }}" class="w-full border rounded px-3 py-2"></div>
    </div>

    <button class="px-4 py-2 bg-blue-600 text-white rounded">Save Article</button>
</form>

@if($article->exists)
<div class="mt-8 space-y-2">
    @can('articles.submit-review')
        <form method="POST" action="{{ route('admin.articles.submit-review', $article) }}">@csrf<button class="px-3 py-2 rounded bg-amber-600 text-white text-sm">Submit Review</button></form>
    @endcan
    @can('articles.approve')
        <form method="POST" action="{{ route('admin.articles.approve', $article) }}">@csrf<button class="px-3 py-2 rounded bg-indigo-600 text-white text-sm">Approve</button></form>
    @endcan
    @can('articles.publish')
        <form method="POST" action="{{ route('admin.articles.schedule', $article) }}" class="flex items-center gap-2">@csrf
            <input type="datetime-local" name="publish_at" class="border rounded px-2 py-1 text-sm" required>
            <button class="px-3 py-2 rounded bg-slate-700 text-white text-sm">Schedule</button>
        </form>
        <form method="POST" action="{{ route('admin.articles.publish', $article) }}">@csrf<button class="px-3 py-2 rounded bg-emerald-600 text-white text-sm">Publish Now</button></form>
    @endcan
</div>
@endif
@endsection

@extends('layouts.admin')

@section('title', $article->exists ? 'Edit Article' : 'Create Article')
@section('page_title', $article->exists ? 'Edit Article' : 'Create Article')

@section('content')
<form method="POST" action="{{ $article->exists ? route('admin.articles.update', $article) : route('admin.articles.store') }}" class="space-y-6">
    @csrf
    @if($article->exists)
        @method('PUT')
    @endif

    <div class="rounded-xl bg-white border border-slate-200 p-5 sm:p-6 space-y-5 shadow-sm">
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Title</label>
                <input
                    name="title"
                    value="{{ old('title', $article->title) }}"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
                    required
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Slug (optional)</label>
                <input
                    name="slug"
                    value="{{ old('slug', $article->slug) }}"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
                    placeholder="auto-generated from title"
                >
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Subtitle</label>
            <input
                name="subtitle"
                value="{{ old('subtitle', $article->subtitle) }}"
                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
            >
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Excerpt</label>
            <textarea
                name="excerpt"
                rows="3"
                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
                required
            >{{ old('excerpt', $article->excerpt) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Body</label>
            <textarea
                name="body"
                rows="14"
                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
                required
            >{{ old('body', $article->body) }}</textarea>
        </div>

        <div class="grid md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Content Type</label>
                <select name="content_type" class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40">
                    @foreach(['news', 'announcement', 'opinion', 'press_release'] as $type)
                        <option value="{{ $type }}" @selected(old('content_type', $article->content_type) === $type)>
                            {{ ucfirst(str_replace('_', ' ', $type)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Category</label>
                <select name="category_id" class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected((int) old('category_id', $article->category_id) === $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Featured Image</label>
                <select name="featured_image_id" class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40">
                    <option value="">No image</option>
                    @foreach($media as $item)
                        <option value="{{ $item->id }}" @selected((int) old('featured_image_id', $article->featured_image_id) === $item->id)>
                            {{ $item->filename }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Tags</label>
            <select name="tags[]" multiple class="w-full rounded-lg border border-slate-300 px-3 py-2 h-32 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40">
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" @selected(in_array($tag->id, old('tags', $selectedTags)))>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid sm:grid-cols-2 gap-3 text-sm">
            <label class="inline-flex items-center gap-2">
                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $article->is_featured))>
                Mark as featured
            </label>

            <label class="inline-flex items-center gap-2">
                <input type="checkbox" name="is_indexable" value="1" @checked(old('is_indexable', $article->is_indexable ?? true))>
                Search indexable
            </label>
        </div>
    </div>

    <div class="rounded-xl bg-white border border-slate-200 p-5 sm:p-6 shadow-sm">
        <h3 class="text-sm uppercase tracking-[0.16em] text-slate-500">SEO</h3>

        <div class="mt-4 grid md:grid-cols-2 gap-4">
            <input
                name="meta_title"
                value="{{ old('meta_title', $article->meta_title) }}"
                class="rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
                placeholder="Meta title"
            >

            <input
                name="meta_description"
                value="{{ old('meta_description', $article->meta_description) }}"
                class="rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
                placeholder="Meta description"
            >

            <input
                name="og_title"
                value="{{ old('og_title', $article->og_title) }}"
                class="rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
                placeholder="OG title"
            >

            <input
                name="og_description"
                value="{{ old('og_description', $article->og_description) }}"
                class="rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
                placeholder="OG description"
            >

            <input
                name="canonical_url"
                value="{{ old('canonical_url', $article->canonical_url) }}"
                class="md:col-span-2 rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
                placeholder="Canonical URL"
            >
        </div>
    </div>

    <div class="flex flex-wrap gap-3">
        <button class="px-5 py-2.5 rounded-lg bg-[#0F4C6C] text-white font-medium hover:bg-[#0d425d] transition-colors">
            Save Article
        </button>

        <a href="{{ route('admin.articles.index') }}" class="px-5 py-2.5 rounded-lg border border-slate-300 bg-white text-slate-700 hover:bg-slate-50 transition-colors">
            Back to list
        </a>
    </div>
</form>

@if($article->exists)
    <section class="mt-8 rounded-xl bg-white border border-slate-200 p-5 sm:p-6 shadow-sm">
        <h3 class="text-sm uppercase tracking-[0.16em] text-slate-500 mb-4">Workflow Actions</h3>

        <div class="flex flex-wrap items-center gap-3">
            @can('articles.submit-review')
                <form method="POST" action="{{ route('admin.articles.submit-review', $article) }}">
                    @csrf
                    <button class="px-4 py-2 bg-amber-600 text-white text-sm">
                        Submit Review
                    </button>
                </form>
            @endcan

            @can('articles.approve')
                <form method="POST" action="{{ route('admin.articles.approve', $article) }}">
                    @csrf
                    <button class="px-4 py-2 bg-indigo-700 text-white text-sm">
                        Approve
                    </button>
                </form>
            @endcan

            @can('articles.publish')
                <form method="POST" action="{{ route('admin.articles.schedule', $article) }}" class="flex items-center gap-2">
                    @csrf
                    <input type="datetime-local" name="publish_at" class="rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40" required>
                    <button class="px-4 py-2 bg-slate-700 text-white text-sm">
                        Schedule
                    </button>
                </form>

                <form method="POST" action="{{ route('admin.articles.publish', $article) }}">
                    @csrf
                    <button class="px-4 py-2 bg-emerald-700 text-white text-sm">
                        Publish Now
                    </button>
                </form>
            @endcan
        </div>
    </section>
@endif
@endsection
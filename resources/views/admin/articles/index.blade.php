@extends('layouts.admin')

@section('title', 'Articles')
@section('page_title', 'Article Management')

@section('content')
<div class="rounded-xl bg-white border border-slate-200 p-4 sm:p-5 mb-5 shadow-sm">
    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">
        <form method="GET" class="grid sm:grid-cols-2 lg:grid-cols-4 gap-2 text-sm">
            <select name="status" class="rounded-lg border border-slate-300 px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40">
                <option value="">All Status</option>
                @foreach(['draft', 'pending_review', 'approved', 'scheduled', 'published'] as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status)>
                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                    </option>
                @endforeach
            </select>

            <select name="category_id" class="rounded-lg border border-slate-300 px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40">
                <option value="">All Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected((string) request('category_id') === (string) $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <select name="content_type" class="rounded-lg border border-slate-300 px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40">
                <option value="">All Type</option>
                @foreach(['news', 'announcement', 'opinion', 'press_release'] as $type)
                    <option value="{{ $type }}" @selected(request('content_type') === $type)>
                        {{ ucfirst(str_replace('_', ' ', $type)) }}
                    </option>
                @endforeach
            </select>

            <button class="px-4 py-2 rounded-lg bg-slate-800 text-white hover:bg-slate-700 transition-colors">
                Apply Filters
            </button>
        </form>

        <a href="{{ route('admin.articles.create') }}" class="inline-flex px-4 py-2 rounded-lg bg-[#0F4C6C] text-white text-sm font-medium hover:bg-[#0d425d] transition-colors">
            Create Article
        </a>
    </div>
</div>

<div class="rounded-xl bg-white border border-slate-200 overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-600">
                <tr>
                    <th class="p-4 text-left font-medium">Title</th>
                    <th class="p-4 text-left font-medium">Status</th>
                    <th class="p-4 text-left font-medium">Type</th>
                    <th class="p-4 text-left font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $article)
                    <tr class="border-t border-slate-200 hover:bg-slate-50/70">
                        <td class="p-4">
                            <p class="font-medium text-slate-900">{{ $article->title }}</p>
                            <p class="text-xs text-slate-500 mt-1">
                                {{ $article->category?->name }} · {{ $article->author?->name }}
                            </p>
                        </td>

                        <td class="p-4">
                            <span class="px-2.5 py-1 text-xs rounded-full border border-[#0F4C6C]/20 bg-[#F1F7FB] text-[#0F4C6C]">
                                {{ $article->status }}
                            </span>
                        </td>

                        <td class="p-4 text-slate-600">
                            {{ $article->content_type }}
                        </td>

                        <td class="p-4">
                            <div class="flex gap-3 text-sm">
                                <a class="text-blue-700 hover:text-blue-900" href="{{ route('admin.articles.edit', $article) }}">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" onsubmit="return confirm('Delete this article?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-rose-700 hover:text-rose-900">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-8 text-center text-slate-500">
                            No articles found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $articles->links() }}
</div>
@endsection
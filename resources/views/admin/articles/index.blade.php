@extends('layouts.admin')

@section('title', 'Articles')
@section('page_title', 'Article Management')

@section('content')
<div class="rounded-xl bg-white border border-slate-200 p-4 sm:p-5 mb-5 shadow-sm">
    <div class="flex flex-col xl:flex-row xl:items-end xl:justify-between gap-4">
        <form method="GET" class="grid sm:grid-cols-2 lg:grid-cols-5 gap-2 text-sm flex-1">
            <input
                name="q"
                value="{{ request('q') }}"
                class="rounded-lg border border-slate-300 px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
                placeholder="Search title..."
            >

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

        <a href="{{ route('admin.articles.create') }}" class="inline-flex justify-center px-4 py-2 rounded-lg bg-[#0F4C6C] text-white text-sm font-medium hover:bg-[#0d425d] transition-colors">
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
                    <th class="p-4 text-left font-medium">Category</th>
                    <th class="p-4 text-left font-medium">Author</th>
                    <th class="p-4 text-right font-medium">Views</th>
                    <th class="p-4 text-left font-medium">Updated At</th>
                    <th class="p-4 text-left font-medium">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $article)
                    <tr class="border-t border-slate-200 hover:bg-slate-50/70">
                        <td class="p-4 min-w-[260px]">
                            <p class="font-medium text-slate-900">{{ $article->title }}</p>
                            <p class="text-xs text-slate-500 mt-1">
                                {{ ucfirst(str_replace('_', ' ', $article->content_type)) }}
                                @if($article->published_at)
                                    · Published {{ $article->published_at->format('d M Y') }}
                                @endif
                            </p>
                        </td>

                        <td class="p-4">
                            <span class="px-2.5 py-1 text-xs rounded-full border border-[#0F4C6C]/20 bg-[#F1F7FB] text-[#0F4C6C] whitespace-nowrap">
                                {{ ucfirst(str_replace('_', ' ', $article->status)) }}
                            </span>
                        </td>

                        <td class="p-4 text-slate-600 whitespace-nowrap">
                            {{ $article->category?->name ?? '-' }}
                        </td>

                        <td class="p-4 text-slate-600 whitespace-nowrap">
                            {{ $article->display_author_name }}
                        </td>

                        <td class="p-4 text-right font-medium text-[#0F4C6C] whitespace-nowrap">
                            {{ number_format((int) $article->view_count, 0, ',', '.') }}
                        </td>

                        <td class="p-4 text-slate-500 whitespace-nowrap">
                            {{ $article->updated_at?->format('d M Y H:i') }}
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
                        <td colspan="7" class="p-8 text-center text-slate-500">
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

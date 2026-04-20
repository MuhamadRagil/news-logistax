@extends('layouts.admin')

@section('title', 'Articles')
@section('page_title', 'Articles')

@section('content')
<div class="mb-4 flex justify-between">
    <form method="GET" class="flex gap-2 text-sm">
        <select name="status" class="border rounded px-2 py-1">
            <option value="">All Status</option>
            @foreach(['draft','pending_review','approved','scheduled','published'] as $status)
                <option value="{{ $status }}" @selected(request('status') === $status)>{{ $status }}</option>
            @endforeach
        </select>
        <select name="category_id" class="border rounded px-2 py-1">
            <option value="">All Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected((string)request('category_id') === (string)$category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        <button class="px-3 py-1 bg-slate-800 text-white rounded">Filter</button>
    </form>
    <a href="{{ route('admin.articles.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded text-sm">New Article</a>
</div>

<div class="bg-white border rounded-lg overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50">
            <tr>
                <th class="p-3 text-left">Title</th>
                <th class="text-left">Status</th>
                <th class="text-left">Type</th>
                <th class="text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
                <tr class="border-t">
                    <td class="p-3">{{ $article->title }}</td>
                    <td>{{ $article->status }}</td>
                    <td>{{ $article->content_type }}</td>
                    <td class="space-x-2">
                        <a class="text-blue-700" href="{{ route('admin.articles.edit', $article) }}">Edit</a>
                        <form class="inline" method="POST" action="{{ route('admin.articles.destroy', $article) }}">
                            @csrf @method('DELETE')
                            <button class="text-rose-700" onclick="return confirm('Delete this article?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $articles->links() }}</div>
@endsection

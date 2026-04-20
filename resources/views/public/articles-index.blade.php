@extends('layouts.public')
@section('title', 'Articles - Logistax News')
@section('content')
<h1 class="text-2xl font-bold mb-4">Articles</h1>
<form method="GET" class="flex gap-2 mb-4">
    <input name="q" value="{{ request('q') }}" class="border rounded px-3 py-2" placeholder="Search...">
    <select name="category" class="border rounded px-3 py-2">
        <option value="">All categories</option>
        @foreach($categories as $category)
            <option value="{{ $category->slug }}" @selected(request('category')===$category->slug)>{{ $category->name }}</option>
        @endforeach
    </select>
    <button class="px-4 py-2 bg-slate-800 text-white rounded">Apply</button>
</form>
<div class="space-y-4">
    @foreach($articles as $article)
    <article class="border rounded p-4">
        <a href="{{ route('articles.show', $article->slug) }}" class="text-xl font-semibold">{{ $article->title }}</a>
        <p class="text-sm text-slate-600">{{ $article->excerpt }}</p>
    </article>
    @endforeach
</div>
<div class="mt-6">{{ $articles->links() }}</div>
@endsection

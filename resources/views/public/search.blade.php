@extends('layouts.public')
@section('title', 'Search - Logistax News')
@section('content')
<h1 class="text-2xl font-bold mb-4">Search</h1>
<form method="GET" class="mb-6">
    <input name="q" value="{{ $q }}" class="border rounded px-3 py-2 w-full max-w-xl" placeholder="Search by keyword...">
</form>
<div class="space-y-4">
    @forelse($articles as $article)
        <article class="border rounded p-4">
            <a href="{{ route('articles.show', $article->slug) }}" class="text-xl font-semibold">{{ $article->title }}</a>
            <p class="text-sm text-slate-600">{{ $article->excerpt }}</p>
        </article>
    @empty
        <p class="text-slate-500">No results found.</p>
    @endforelse
</div>
<div class="mt-6">{{ $articles->links() }}</div>
@endsection

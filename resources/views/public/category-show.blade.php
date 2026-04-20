@extends('layouts.public')
@section('title', $category->name.' - Logistax News')
@section('content')
<h1 class="text-2xl font-bold mb-2">{{ $category->name }}</h1>
<p class="text-slate-600 mb-6">{{ $category->description }}</p>
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

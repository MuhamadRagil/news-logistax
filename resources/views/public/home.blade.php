@extends('layouts.public')
@section('title', 'Logistax News')
@section('content')
@if($featured)
    <section class="mb-8">
        <p class="text-xs uppercase text-slate-500 mb-2">Featured</p>
        <a href="{{ route('articles.show', $featured->slug) }}" class="text-3xl font-bold block">{{ $featured->title }}</a>
        <p class="text-slate-600 mt-2">{{ $featured->excerpt }}</p>
    </section>
@endif

<section>
    <h2 class="text-xl font-semibold mb-4">Latest Articles</h2>
    <div class="grid md:grid-cols-2 gap-4">
        @foreach($latest as $article)
            <article class="border rounded p-4">
                <p class="text-xs text-slate-500">{{ $article->category?->name }}</p>
                <a href="{{ route('articles.show', $article->slug) }}" class="font-semibold text-lg">{{ $article->title }}</a>
                <p class="text-sm mt-1">{{ $article->excerpt }}</p>
            </article>
        @endforeach
    </div>
</section>
@endsection

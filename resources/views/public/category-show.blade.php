@extends('layouts.public')
@section('title', $category->name.' - Logistax Newsroom')

@section('content')
<section class="border-b border-stone-200 pb-6">
    <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Category</p>
    <h1 class="mt-2 text-3xl font-semibold text-slate-900">{{ $category->name }}</h1>
    <p class="mt-3 text-slate-600 max-w-3xl">{{ $category->description }}</p>
</section>

<div class="mt-8 space-y-4">
    @forelse($articles as $article)
        <article class="bg-white border border-stone-200 p-6">
            <p class="text-xs text-slate-500">{{ optional($article->published_at)->format('d M Y') }}</p>
            <a href="{{ route('articles.show', $article->slug) }}" class="mt-2 block text-2xl font-semibold text-slate-900 hover:text-slate-700">{{ $article->title }}</a>
            <p class="mt-3 text-slate-600">{{ $article->excerpt }}</p>
        </article>
    @empty
        <div class="bg-white border border-stone-200 p-8 text-center text-slate-500">Belum ada artikel pada kategori ini.</div>
    @endforelse
</div>

<div class="mt-8">{{ $articles->links() }}</div>
@endsection

@extends('layouts.public')
@section('title', 'Pencarian - Logistax Newsroom')

@section('content')
<section class="border-b border-stone-200 pb-6">
    <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Search</p>
    <h1 class="mt-2 text-3xl font-semibold text-slate-900">Pencarian Artikel</h1>
    <form method="GET" class="mt-4 max-w-2xl flex gap-2">
        <input name="q" value="{{ $q }}" class="flex-1 border border-stone-300 bg-white px-3 py-2" placeholder="Cari topik, regulasi, atau istilah...">
        <button class="px-4 py-2 bg-slate-900 text-white">Cari</button>
    </form>
</section>

<div class="mt-8 space-y-4">
    @forelse($articles as $article)
        <article class="bg-white border border-stone-200 p-5">
            <a href="{{ route('articles.show', $article->slug) }}" class="text-xl font-semibold text-slate-900 hover:text-slate-700">{{ $article->title }}</a>
            <p class="text-sm text-slate-500 mt-1">{{ $article->category?->name }} · {{ optional($article->published_at)->format('d M Y') }}</p>
            <p class="mt-2 text-slate-600">{{ $article->excerpt }}</p>
        </article>
    @empty
        <div class="bg-white border border-stone-200 p-8 text-center text-slate-500">Tidak ada hasil ditemukan untuk kata kunci "{{ $q }}".</div>
    @endforelse
</div>

<div class="mt-8">{{ $articles->links() }}</div>
@endsection

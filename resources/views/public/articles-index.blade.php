@extends('layouts.public')
@section('title', 'Semua Artikel - Logistax Newsroom')

@section('content')
<div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 border-b border-stone-200 pb-6">
    <div>
        <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Archive</p>
        <h1 class="mt-2 text-3xl font-semibold text-slate-900">Semua Artikel</h1>
    </div>
    <form method="GET" class="grid sm:grid-cols-3 gap-2 text-sm w-full md:w-auto">
        <input name="q" value="{{ request('q') }}" class="border border-stone-300 bg-white px-3 py-2" placeholder="Cari kata kunci...">
        <select name="category" class="border border-stone-300 bg-white px-3 py-2">
            <option value="">Semua kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category->slug }}" @selected(request('category')===$category->slug)>{{ $category->name }}</option>
            @endforeach
        </select>
        <button class="px-4 py-2 bg-slate-900 text-white font-medium">Terapkan</button>
    </form>
</div>

<div class="mt-8 space-y-4">
    @forelse($articles as $article)
        <article class="bg-white border border-stone-200 p-6">
            <p class="text-xs uppercase tracking-wide text-slate-500">{{ $article->category?->name }} · {{ optional($article->published_at)->format('d M Y') }}</p>
            <a href="{{ route('articles.show', $article->slug) }}" class="block mt-2 text-2xl font-semibold leading-tight text-slate-900 hover:text-slate-700">{{ $article->title }}</a>
            <p class="mt-3 text-slate-600 leading-relaxed">{{ $article->excerpt }}</p>
        </article>
    @empty
        <div class="bg-white border border-stone-200 p-10 text-center text-slate-500">
            Tidak ada artikel yang sesuai dengan filter.
        </div>
    @endforelse
</div>

<div class="mt-8">{{ $articles->links() }}</div>
@endsection

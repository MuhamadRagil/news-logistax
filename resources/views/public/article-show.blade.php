@extends('layouts.public')
@section('title', $article->meta_title ?? $article->title)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="border-b border-stone-200 pb-8">
        <p class="text-xs uppercase tracking-[0.2em] text-slate-500">{{ $article->category?->name }}</p>
        <h1 class="mt-3 text-3xl md:text-5xl leading-tight font-semibold text-slate-900">{{ $article->title }}</h1>
        @if($article->subtitle)
            <p class="mt-4 text-lg md:text-xl text-slate-600 max-w-3xl">{{ $article->subtitle }}</p>
        @endif

        <div class="mt-6 flex flex-wrap gap-x-5 gap-y-2 text-sm text-slate-500">
            <span>Penulis: <strong class="text-slate-700">{{ $article->author?->name }}</strong></span>
            <span>Dipublikasikan: <strong class="text-slate-700">{{ optional($article->published_at)->format('d M Y H:i') }}</strong></span>
            <span>Jenis: <strong class="text-slate-700">{{ $article->content_type }}</strong></span>
        </div>
    </div>

    @if($article->featuredImage)
        <figure class="mt-8">
            <img class="w-full max-h-[460px] object-cover border border-stone-200" src="{{ asset('storage/'.$article->featuredImage->path) }}" alt="{{ $article->featuredImage->alt_text }}">
            @if($article->featuredImage->caption || $article->featuredImage->credit)
                <figcaption class="mt-2 text-xs text-slate-500">
                    {{ $article->featuredImage->caption }}
                    @if($article->featuredImage->credit)
                        <span class="ml-2">© {{ $article->featuredImage->credit }}</span>
                    @endif
                </figcaption>
            @endif
        </figure>
    @endif

    <article class="prose prose-slate max-w-none mt-10 prose-headings:font-semibold prose-p:leading-8 prose-p:text-[17px] prose-li:leading-8">
        {!! nl2br(e($article->body)) !!}
    </article>

    <section class="mt-10 border-t border-stone-200 pt-6">
        <div class="flex flex-wrap items-center gap-2 text-sm">
            <span class="text-slate-500">Tags:</span>
            @forelse($article->tags as $tag)
                <span class="px-2.5 py-1 border border-stone-300 text-slate-700">{{ $tag->name }}</span>
            @empty
                <span class="text-slate-400">Tidak ada tag</span>
            @endforelse
        </div>

        <div class="mt-6 text-sm text-slate-500">
            Bagikan: <span class="ml-1 text-slate-700">Link artikel resmi Logistax Newsroom</span>
        </div>
    </section>

    <section class="mt-12">
        <h2 class="text-xl font-semibold text-slate-900 mb-4">Artikel Terkait</h2>
        <div class="grid md:grid-cols-2 gap-4">
            @foreach($related as $item)
                <a href="{{ route('articles.show', $item->slug) }}" class="block bg-white border border-stone-200 p-4 hover:border-stone-300">
                    <p class="text-xs text-slate-500">{{ optional($item->published_at)->format('d M Y') }}</p>
                    <p class="mt-1 font-semibold text-slate-900">{{ $item->title }}</p>
                </a>
            @endforeach
        </div>
    </section>
</div>
@endsection

@extends('layouts.public')

@section('title', $article->meta_title ?? $article->title)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="rounded-2xl border border-[#0F4C6C]/15 bg-white p-6 md:p-8">
        <p class="inline-flex items-center rounded-full border border-[#3FA7D6]/35 bg-[#3FA7D6]/10 px-3 py-1 text-[11px] uppercase tracking-[0.2em] text-[#0F4C6C]">
            {{ $article->category?->name }}
        </p>

        <h1 class="mt-4 text-3xl md:text-5xl leading-tight font-semibold text-[#0F4C6C]">
            {{ $article->title }}
        </h1>

        @if($article->subtitle)
            <p class="mt-4 text-lg md:text-xl text-[#0F4C6C]/80 max-w-3xl">
                {{ $article->subtitle }}
            </p>
        @endif

        <div class="mt-6 flex flex-wrap gap-x-5 gap-y-2 text-sm text-[#0F4C6C]/70 border-b border-[#0F4C6C]/10 pb-6">
            <span>
                Penulis:
                <strong class="text-[#0F4C6C]">{{ $article->author?->name }}</strong>
            </span>

            <span>
                Dipublikasikan:
                <strong class="text-[#0F4C6C]">{{ optional($article->published_at)->format('d M Y H:i') }}</strong>
            </span>

            <span>
                Jenis:
                <strong class="text-[#0F4C6C]">{{ $article->content_type }}</strong>
            </span>
        </div>

        @if($article->featuredImage)
            <figure class="mt-8 rounded-2xl overflow-hidden border border-[#0F4C6C]/10 bg-[#F8FAFC]">
                <img
                    class="w-full max-h-[480px] object-cover"
                    src="{{ asset('storage/' . $article->featuredImage->path) }}"
                    alt="{{ $article->featuredImage->alt_text ?: $article->title }}"
                >

                @if($article->featuredImage->caption || $article->featuredImage->credit)
                    <figcaption class="px-4 py-3 text-xs text-[#0F4C6C]/65 border-t border-[#0F4C6C]/10 bg-white">
                        {{ $article->featuredImage->caption }}
                        @if($article->featuredImage->credit)
                            <span class="ml-2">© {{ $article->featuredImage->credit }}</span>
                        @endif
                    </figcaption>
                @endif
            </figure>
        @endif

        <article class="prose prose-slate max-w-none mt-10 prose-headings:font-semibold prose-p:leading-8 prose-p:text-[17px] prose-li:leading-8 prose-a:text-[#0F4C6C]">
            {!! nl2br(e($article->body)) !!}
        </article>

        <section class="mt-10 border-t border-[#0F4C6C]/10 pt-6">
            <div class="flex flex-wrap items-center gap-2 text-sm">
                <span class="text-[#0F4C6C]/70">Tags:</span>

                @forelse($article->tags as $tag)
                    <span class="px-2.5 py-1 rounded-full border border-[#0F4C6C]/20 text-[#0F4C6C]/85 bg-[#F8FAFC]">
                        {{ $tag->name }}
                    </span>
                @empty
                    <span class="text-[#0F4C6C]/55">Tidak ada tag</span>
                @endforelse
            </div>

            <div class="mt-6 text-sm text-[#0F4C6C]/70">
                Bagikan:
                <span class="ml-1 text-[#0F4C6C]">Link artikel resmi Logistax Newsroom</span>
            </div>
        </section>
    </div>

    <section class="mt-10 rounded-2xl border border-[#0F4C6C]/15 bg-[#F8FAFC] p-5 md:p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-[#0F4C6C]">Artikel Terkait</h2>
            <span class="h-px w-20 bg-[#3FA7D6]/60"></span>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            @forelse($related as $item)
                <a
                    href="{{ route('articles.show', $item->slug) }}"
                    class="block rounded-xl bg-white border border-[#0F4C6C]/10 p-4 hover:border-[#3FA7D6]/60 transition-colors"
                >
                    @if($item->featuredImage)
                        <img
                            class="w-full h-32 object-cover rounded-lg border border-[#0F4C6C]/10 mb-3"
                            src="{{ asset('storage/' . $item->featuredImage->path) }}"
                            alt="{{ $item->featuredImage->alt_text ?: $item->title }}"
                        >
                    @endif
                    <p class="text-xs text-[#0F4C6C]/65">
                        {{ optional($item->published_at)->format('d M Y') }}
                    </p>
                    <p class="mt-1 font-semibold text-[#0F4C6C]">
                        {{ $item->title }}
                    </p>
                </a>
            @empty
                <div class="md:col-span-2 rounded-xl border border-dashed border-[#3FA7D6]/50 bg-white p-8 text-center text-[#0F4C6C]/70">
                    Belum ada artikel terkait pada kategori ini.
                </div>
            @endforelse
        </div>
    </section>
</div>
@endsection

@extends('layouts.public')

@section('title', 'Pencarian - Logistax Newsroom')

@section('content')
<section class="rounded-2xl border border-[#0F4C6C]/15 bg-white p-6 md:p-7">
    <div class="border-b border-[#0F4C6C]/10 pb-6">
        <p class="text-xs uppercase tracking-[0.2em] text-[#0F4C6C]/70">Search</p>
        <h1 class="mt-2 text-3xl font-semibold text-[#0F4C6C]">Pencarian Artikel</h1>

        <form method="GET" class="mt-4 max-w-2xl flex gap-2">
            <input
                name="q"
                value="{{ $q }}"
                class="flex-1 border border-[#0F4C6C]/25 rounded-lg bg-white px-3 py-2 text-[#0F4C6C] placeholder:text-[#0F4C6C]/45 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/50"
                placeholder="Cari topik, regulasi, atau istilah..."
            >
            <button class="px-4 py-2 rounded-lg bg-[#0F4C6C] text-white hover:bg-[#0c415d] transition-colors">
                Cari
            </button>
        </form>
    </div>

    <div class="mt-8 space-y-4">
        @forelse($articles as $article)
            <article class="bg-[#F8FAFC] border border-[#0F4C6C]/10 rounded-xl p-5 hover:border-[#3FA7D6]/60 transition-colors">
                <a
                    href="{{ route('articles.show', $article->slug) }}"
                    class="text-xl font-semibold text-[#0F4C6C] hover:text-[#3FA7D6] transition-colors"
                >
                    {{ $article->title }}
                </a>

                <p class="text-sm text-[#0F4C6C]/65 mt-1">
                    {{ $article->category?->name }} · {{ optional($article->published_at)->format('d M Y') }}
                </p>

                <p class="mt-2 text-[#0F4C6C]/80 leading-relaxed">
                    {{ $article->excerpt }}
                </p>
            </article>
        @empty
            <div class="rounded-2xl border border-dashed border-[#3FA7D6]/50 bg-[#F8FAFC] p-8 text-center">
                <p class="font-semibold text-[#0F4C6C]">Tidak ada hasil untuk "{{ $q }}".</p>
                <p class="mt-2 text-sm text-[#0F4C6C]/70">Gunakan kata kunci yang lebih umum atau jelajahi semua artikel terbaru.</p>
                <a href="{{ route('articles.index') }}" class="inline-flex mt-4 rounded-full bg-[#0F4C6C] px-4 py-2 text-sm font-medium text-white hover:bg-[#0c415d] transition-colors">Jelajahi Artikel</a>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $articles->links() }}
    </div>
</section>
@endsection

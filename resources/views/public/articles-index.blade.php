@extends('layouts.public')

@section('title', 'Semua Artikel - Logistax Newsroom')

@section('content')
<div class="rounded-2xl border border-[#0F4C6C]/15 bg-white p-5 md:p-6">
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-5 border-b border-[#0F4C6C]/10 pb-6">
        <div>
            <p class="text-xs uppercase tracking-[0.2em] text-[#0F4C6C]/70">Archive</p>
            <h1 class="mt-2 text-3xl font-semibold text-[#0F4C6C]">Semua Artikel</h1>
        </div>

        <form method="GET" class="grid sm:grid-cols-3 gap-2 text-sm w-full md:w-auto">
            <input
                name="q"
                value="{{ request('q') }}"
                class="border border-[#0F4C6C]/25 rounded-lg bg-white px-3 py-2 text-[#0F4C6C] placeholder:text-[#0F4C6C]/45 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/50"
                placeholder="Cari kata kunci..."
            >

            <select name="category" class="border border-[#0F4C6C]/25 rounded-lg bg-white px-3 py-2 text-[#0F4C6C] focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/50">
                <option value="">Semua kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <button class="px-4 py-2 rounded-lg bg-[#0F4C6C] text-white font-medium hover:bg-[#0c415d] transition-colors">
                Terapkan
            </button>
        </form>
    </div>

    <div class="mt-8 space-y-4">
        @forelse($articles as $article)
            <article class="bg-[#F8FAFC] border border-[#0F4C6C]/10 rounded-xl p-6 hover:border-[#3FA7D6]/60 transition-colors">
                <div class="flex flex-col md:flex-row gap-5">
                    @if($article->featuredImage)
                        <a href="{{ route('articles.show', $article->slug) }}" class="md:w-52 shrink-0 overflow-hidden rounded-lg border border-[#0F4C6C]/10">
                            <img
                                class="h-36 w-full object-cover"
                                src="{{ asset('storage/' . $article->featuredImage->path) }}"
                                alt="{{ $article->featuredImage->alt_text ?: $article->title }}"
                            >
                        </a>
                    @endif

                    <div class="min-w-0">
                        <p class="text-xs uppercase tracking-wide text-[#0F4C6C]/65">
                            {{ $article->category?->name }} · {{ optional($article->published_at)->format('d M Y') }}
                        </p>

                        <a
                            href="{{ route('articles.show', $article->slug) }}"
                            class="block mt-2 text-2xl font-semibold leading-tight text-[#0F4C6C] hover:text-[#3FA7D6] transition-colors"
                        >
                            {{ $article->title }}
                        </a>

                        <p class="mt-3 text-[#0F4C6C]/80 leading-relaxed">
                            {{ $article->excerpt }}
                        </p>
                    </div>
                </div>
            </article>
        @empty
            <div class="rounded-2xl border border-dashed border-[#3FA7D6]/50 bg-[#F8FAFC] p-10 text-center">
                <p class="text-base font-semibold text-[#0F4C6C]">Belum ada artikel yang sesuai.</p>
                <p class="mt-2 text-sm text-[#0F4C6C]/70">Coba ubah kata kunci atau pilih kategori lain untuk menemukan konten.</p>
                <a href="{{ route('articles.index') }}" class="inline-flex mt-4 rounded-full bg-[#0F4C6C] px-4 py-2 text-sm font-medium text-white hover:bg-[#0c415d] transition-colors">Reset Filter</a>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $articles->links() }}
    </div>
</div>
@endsection

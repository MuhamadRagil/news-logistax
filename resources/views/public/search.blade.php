@extends('layouts.public')

@section('title', 'Pencarian - Logistax Newsroom')

@section('content')
<nav class="flex items-center gap-1.5 text-xs text-slate-500 mb-4">
    <a href="{{ route('home') }}" class="hover:text-[#0F4C6C] transition-colors">Beranda</a>
    <span>/</span>
    <span class="text-slate-400">Hasil Pencarian</span>
</nav>

<section class="rounded-2xl border border-slate-200 bg-white p-6 md:p-7">
    <div class="border-b border-slate-200 pb-6">
        <p class="text-xs font-bold uppercase tracking-wide text-[#0F4C6C]">Search</p>
        <h1 class="mt-2 text-3xl font-extrabold text-[#0F172A] tracking-tight">Pencarian Artikel</h1>

        <form method="GET" class="mt-4 max-w-2xl flex gap-2">
            <input
                name="q"
                value="{{ $q }}"
                class="flex-1 border border-slate-300 rounded-lg bg-white px-3 py-2 text-[#0F172A] placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/50"
                placeholder="Cari topik, regulasi, atau istilah..."
            >
            <button class="px-4 py-2 rounded-lg bg-[#0F4C6C] text-white font-bold hover:bg-[#0c415d] transition-colors">
                Cari
            </button>
        </form>

        <p class="mt-4 text-sm text-slate-500">
            @if($q !== '')
                Menampilkan hasil untuk: <span class="font-bold text-[#0F172A]">"{{ $q }}"</span>
                <span class="font-mono text-slate-400">({{ $articles->total() }} artikel)</span>
            @else
                Menampilkan semua artikel terbaru
                <span class="font-mono text-slate-400">({{ $articles->total() }} artikel)</span>
            @endif
        </p>
    </div>

    <div class="mt-8 space-y-4">
        @forelse($articles as $article)
            @include('public.partials.article-list-item')
        @empty
            <div class="rounded-2xl border border-dashed border-[#3FA7D6]/50 bg-[#F8FAFC] p-8 text-center">
                <p class="font-bold text-[#0F172A]">Tidak ada hasil untuk "{{ $q }}".</p>
                <p class="mt-2 text-sm text-slate-500">Gunakan kata kunci yang lebih umum, atau jelajahi artikel dan kategori di bawah ini.</p>

                <div class="mt-5 flex flex-wrap items-center justify-center gap-2">
                    <a
                        href="{{ route('articles.index') }}"
                        class="inline-flex rounded-full bg-[#0F4C6C] px-4 py-2 text-sm font-bold text-white hover:bg-[#0c415d] transition-colors"
                    >
                        Jelajahi Semua Artikel
                    </a>

                    @foreach($categories as $category)
                        <a
                            href="{{ route('categories.show', $category->slug) }}"
                            class="inline-flex rounded-full border border-slate-300 bg-white px-4 py-2 text-sm font-bold text-[#0F172A] hover:border-[#3FA7D6]/70 hover:text-[#0F4C6C] transition-colors"
                        >
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $articles->links() }}
    </div>
</section>
@endsection

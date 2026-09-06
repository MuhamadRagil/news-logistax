@extends('layouts.public')

@section('title', 'Semua Artikel - Logistax Newsroom')

@section('content')
<nav class="flex items-center gap-1.5 text-xs text-slate-500 mb-4">
    <a href="{{ route('home') }}" class="hover:text-[#0F4C6C] transition-colors">Beranda</a>
    <span>/</span>
    <span class="text-slate-400">Semua Artikel</span>
</nav>

<div class="rounded-2xl border border-slate-200 bg-white p-5 md:p-6">
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-5 border-b border-slate-200 pb-6">
        <div>
            <p class="text-xs font-bold uppercase tracking-wide text-[#0F4C6C]">Archive</p>
            <h1 class="mt-2 text-3xl font-extrabold text-[#0F172A] tracking-tight">Semua Artikel</h1>
        </div>

        <form method="GET" class="grid sm:grid-cols-3 gap-2 text-sm w-full md:w-auto">
            <input
                name="q"
                value="{{ request('q') }}"
                class="border border-slate-300 rounded-lg bg-white px-3 py-2 text-[#0F172A] placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/50"
                placeholder="Cari kata kunci..."
            >

            <select
                name="category"
                class="border border-slate-300 rounded-lg bg-white px-3 py-2 text-[#0F172A] focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/50"
            >
                <option value="">Semua kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <button class="px-4 py-2 rounded-lg bg-[#0F4C6C] text-white font-bold hover:bg-[#0c415d] transition-colors">
                Terapkan
            </button>
        </form>
    </div>

    <div class="mt-8 space-y-4">
        @forelse($articles as $article)
            @include('public.partials.article-list-item')
        @empty
            <div class="rounded-2xl border border-dashed border-[#3FA7D6]/50 bg-[#F8FAFC] p-10 text-center">
                <p class="text-base font-bold text-[#0F172A]">Belum ada artikel yang sesuai.</p>
                <p class="mt-2 text-sm text-[#475569]">Coba ubah kata kunci atau pilih kategori lain untuk menemukan konten.</p>
                <a
                    href="{{ route('articles.index') }}"
                    class="inline-flex mt-4 rounded-full bg-[#0F4C6C] px-4 py-2 text-sm font-bold text-white hover:bg-[#0c415d] transition-colors"
                >
                    Reset Filter
                </a>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $articles->links() }}
    </div>
</div>
@endsection

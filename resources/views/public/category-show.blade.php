@extends('layouts.public')

@section('title', $category->name . ' - Logistax Newsroom')

@section('content')
<nav class="flex items-center gap-1.5 text-xs text-slate-500 mb-4">
    <a href="{{ route('home') }}" class="hover:text-[#0F4C6C] transition-colors">Beranda</a>
    <span>/</span>
    <span class="text-slate-400">{{ $category->name }}</span>
</nav>

<section class="rounded-2xl border border-slate-200 bg-white p-6 md:p-7">
    <div class="border-b border-slate-200 pb-6">
        <p class="text-xs font-bold uppercase tracking-wide text-[#0F4C6C]">Category</p>
        <h1 class="mt-2 text-3xl font-extrabold text-[#0F172A] tracking-tight">{{ $category->name }}</h1>
        @if($category->description)
            <p class="mt-3 text-[#475569] max-w-3xl">{{ $category->description }}</p>
        @endif
    </div>

    <div class="mt-8 space-y-4">
        @forelse($articles as $article)
            @include('public.partials.article-list-item')
        @empty
            <div class="rounded-2xl border border-dashed border-[#3FA7D6]/50 bg-[#F8FAFC] p-9 text-center">
                <p class="font-bold text-[#0F172A]">Belum ada artikel pada kategori ini.</p>
                <p class="mt-2 text-sm text-[#475569]">Konten untuk kategori ini akan tampil setelah artikel dipublikasikan.</p>
                <a
                    href="{{ route('articles.index') }}"
                    class="inline-flex mt-4 rounded-full border border-slate-300 bg-white px-4 py-2 text-sm font-bold text-[#0F172A] hover:border-[#3FA7D6]/70 hover:text-[#0F4C6C] transition-colors"
                >
                    Lihat Semua Artikel
                </a>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $articles->links() }}
    </div>
</section>
@endsection

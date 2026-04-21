@extends('layouts.public')

@section('title', $category->name . ' - Logistax Newsroom')

@section('content')
<section class="rounded-2xl border border-[#0F4C6C]/15 bg-white p-6 md:p-7">
    <div class="border-b border-[#0F4C6C]/10 pb-6">
        <p class="text-xs uppercase tracking-[0.2em] text-[#0F4C6C]/70">Category</p>
        <h1 class="mt-2 text-3xl font-semibold text-[#0F4C6C]">{{ $category->name }}</h1>
        <p class="mt-3 text-[#0F4C6C]/80 max-w-3xl">{{ $category->description }}</p>
    </div>

    <div class="mt-8 space-y-4">
        @forelse($articles as $article)
            <article class="bg-[#F8FAFC] border border-[#0F4C6C]/10 rounded-xl p-6 hover:border-[#3FA7D6]/60 transition-colors">
                <div class="flex flex-col md:flex-row gap-5">
                    @if($article->featuredImage)
                        <a href="{{ route('articles.show', $article->slug) }}" class="md:w-48 shrink-0 overflow-hidden rounded-lg border border-[#0F4C6C]/10">
                            <img
                                class="h-32 w-full object-cover"
                                src="{{ asset('storage/' . $article->featuredImage->path) }}"
                                alt="{{ $article->featuredImage->alt_text ?: $article->title }}"
                            >
                        </a>
                    @endif

                    <div>
                        <p class="text-xs text-[#0F4C6C]/65">
                            {{ optional($article->published_at)->format('d M Y') }}
                        </p>

                        <a
                            href="{{ route('articles.show', $article->slug) }}"
                            class="mt-2 block text-2xl font-semibold text-[#0F4C6C] hover:text-[#3FA7D6] transition-colors"
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
            <div class="rounded-2xl border border-dashed border-[#3FA7D6]/50 bg-[#F8FAFC] p-9 text-center">
                <p class="font-semibold text-[#0F4C6C]">Belum ada artikel pada kategori ini.</p>
                <p class="mt-2 text-sm text-[#0F4C6C]/70">Konten untuk kategori ini akan tampil setelah artikel dipublikasikan.</p>
                <a
                    href="{{ route('articles.index') }}"
                    class="inline-flex mt-4 rounded-full border border-[#0F4C6C]/20 bg-white px-4 py-2 text-sm font-medium text-[#0F4C6C] hover:border-[#3FA7D6]/70 hover:text-[#3FA7D6] transition-colors"
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
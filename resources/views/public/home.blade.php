@extends('layouts.public')

@section('title', 'Logistax Newsroom')

@section('content')
@php
    $secondary = $latest->take(4);
    $latestUpdates = $latest->skip(1)->take(6);
    $tax = $latest->filter(fn($a) => str_contains(strtolower($a->category?->name ?? ''), 'pajak'))->take(3);
    $accounting = $latest->filter(fn($a) => str_contains(strtolower($a->category?->name ?? ''), 'akuntansi'))->take(3);
    $law = $latest->filter(fn($a) => str_contains(strtolower($a->category?->name ?? ''), 'hukum'))->take(3);
    $announcements = $latest->where('content_type', 'announcement')->take(3);
    $opinions = $latest->where('content_type', 'opinion')->take(3);
    $pressReleases = $latest->where('content_type', 'press_release')->take(3);
@endphp

<section class="grid lg:grid-cols-12 gap-8 border-b border-[#0F4C6C]/15 pb-10">
    <div class="lg:col-span-7">
        @if($featured)
            <p class="inline-flex items-center gap-2 rounded-full border border-[#3FA7D6]/40 bg-[#3FA7D6]/10 px-3 py-1 text-[11px] uppercase tracking-[0.2em] text-[#0F4C6C]">Lead Story</p>
            <a href="{{ route('articles.show', $featured->slug) }}" class="block mt-4 group">
                <h1 class="text-3xl md:text-5xl leading-tight font-semibold text-[#0F4C6C] max-w-4xl group-hover:text-[#3FA7D6] transition-colors">
                    {{ $featured->title }}
                </h1>
            </a>
            <p class="mt-4 text-[#0F4C6C]/80 leading-relaxed text-base md:text-lg max-w-2xl">
                {{ $featured->excerpt }}
            </p>
            <div class="mt-5 text-sm text-[#0F4C6C]/70 flex gap-4">
                <span>{{ $featured->category?->name }}</span>
                <span>•</span>
                <span>{{ optional($featured->published_at)->format('d M Y') }}</span>
            </div>
        @else
            <div class="rounded-2xl border border-dashed border-[#3FA7D6]/50 bg-white p-8">
                <h1 class="text-2xl md:text-3xl font-semibold text-[#0F4C6C]">Belum ada lead story hari ini</h1>
                <p class="mt-3 text-[#0F4C6C]/70">Tim editorial sedang menyiapkan sorotan utama. Silakan lihat pembaruan terbaru di bawah.</p>
            </div>
        @endif
    </div>

    <div class="lg:col-span-5 space-y-4">
        <h2 class="text-sm uppercase tracking-[0.18em] text-[#0F4C6C]/70">Top Stories</h2>
        <div class="space-y-4 rounded-2xl bg-white border border-[#0F4C6C]/10 p-5">
            @forelse($secondary as $item)
                <article class="border-b border-[#0F4C6C]/10 pb-4 last:border-0 last:pb-0">
                    <p class="text-xs text-[#0F4C6C]/65">{{ $item->category?->name }}</p>
                    <a href="{{ route('articles.show', $item->slug) }}" class="block mt-1 font-semibold text-[#0F4C6C] hover:text-[#3FA7D6] leading-snug transition-colors">
                        {{ $item->title }}
                    </a>
                </article>
            @empty
                <p class="text-sm text-[#0F4C6C]/70">Belum ada top stories untuk ditampilkan.</p>
            @endforelse
        </div>
    </div>
</section>

<section class="grid lg:grid-cols-12 gap-8 mt-10">
    <div class="lg:col-span-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-[#0F4C6C]">Latest Updates</h2>
            <span class="h-px w-20 bg-[#3FA7D6]/60"></span>
        </div>
        <div class="grid md:grid-cols-2 gap-5">
            @forelse($latestUpdates as $item)
                <article class="bg-white border border-[#0F4C6C]/10 rounded-2xl p-5 hover:border-[#3FA7D6]/60 hover:shadow-sm transition-all">
                    <p class="text-[11px] uppercase tracking-[0.14em] text-[#0F4C6C]/65">{{ $item->content_type }}</p>
                    <a href="{{ route('articles.show', $item->slug) }}" class="block mt-2 text-lg font-semibold leading-snug text-[#0F4C6C] hover:text-[#3FA7D6] transition-colors">
                        {{ $item->title }}
                    </a>
                    <p class="mt-2 text-sm text-[#0F4C6C]/75 line-clamp-3">
                        {{ $item->excerpt }}
                    </p>
                </article>
            @empty
                <div class="md:col-span-2 rounded-2xl border border-dashed border-[#3FA7D6]/50 bg-white p-8 text-center">
                    <p class="font-medium text-[#0F4C6C]">Belum ada pembaruan terbaru.</p>
                    <p class="mt-2 text-sm text-[#0F4C6C]/70">Konten baru akan muncul di sini setelah dipublikasikan.</p>
                </div>
            @endforelse
        </div>
    </div>

    <aside class="lg:col-span-4 bg-white border border-[#0F4C6C]/10 rounded-2xl p-6">
        <h3 class="text-sm uppercase tracking-[0.18em] text-[#0F4C6C]/70">Category Focus</h3>
        <div class="mt-4 space-y-6 text-sm">
            <div>
                <p class="font-semibold text-[#0F4C6C]">Pajak</p>
                @forelse($tax as $item)
                    <a class="block mt-2 text-[#0F4C6C]/85 hover:text-[#3FA7D6] transition-colors" href="{{ route('articles.show', $item->slug) }}">
                        {{ $item->title }}
                    </a>
                @empty
                    <p class="mt-2 text-xs text-[#0F4C6C]/60">Belum ada artikel pajak.</p>
                @endforelse
            </div>

            <div>
                <p class="font-semibold text-[#0F4C6C]">Akuntansi</p>
                @forelse($accounting as $item)
                    <a class="block mt-2 text-[#0F4C6C]/85 hover:text-[#3FA7D6] transition-colors" href="{{ route('articles.show', $item->slug) }}">
                        {{ $item->title }}
                    </a>
                @empty
                    <p class="mt-2 text-xs text-[#0F4C6C]/60">Belum ada artikel akuntansi.</p>
                @endforelse
            </div>

            <div>
                <p class="font-semibold text-[#0F4C6C]">Hukum</p>
                @forelse($law as $item)
                    <a class="block mt-2 text-[#0F4C6C]/85 hover:text-[#3FA7D6] transition-colors" href="{{ route('articles.show', $item->slug) }}">
                        {{ $item->title }}
                    </a>
                @empty
                    <p class="mt-2 text-xs text-[#0F4C6C]/60">Belum ada artikel hukum.</p>
                @endforelse
            </div>
        </div>
    </aside>
</section>

<section class="mt-12 grid md:grid-cols-3 gap-6">
    <div class="bg-white border border-[#0F4C6C]/10 rounded-2xl p-5">
        <h3 class="text-sm uppercase tracking-[0.15em] text-[#0F4C6C]/70">Pengumuman</h3>
        <div class="mt-3 space-y-3">
            @forelse($announcements as $item)
                <a href="{{ route('articles.show', $item->slug) }}" class="block text-sm font-medium text-[#0F4C6C] hover:text-[#3FA7D6] transition-colors">
                    {{ $item->title }}
                </a>
            @empty
                <p class="text-sm text-[#0F4C6C]/65">Belum ada pengumuman terbaru.</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white border border-[#0F4C6C]/10 rounded-2xl p-5">
        <h3 class="text-sm uppercase tracking-[0.15em] text-[#0F4C6C]/70">Opini</h3>
        <div class="mt-3 space-y-3">
            @forelse($opinions as $item)
                <a href="{{ route('articles.show', $item->slug) }}" class="block text-sm font-medium text-[#0F4C6C] hover:text-[#3FA7D6] transition-colors">
                    {{ $item->title }}
                </a>
            @empty
                <p class="text-sm text-[#0F4C6C]/65">Belum ada artikel opini terbaru.</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white border border-[#0F4C6C]/10 rounded-2xl p-5">
        <h3 class="text-sm uppercase tracking-[0.15em] text-[#0F4C6C]/70">Press Release</h3>
        <div class="mt-3 space-y-3">
            @forelse($pressReleases as $item)
                <a href="{{ route('articles.show', $item->slug) }}" class="block text-sm font-medium text-[#0F4C6C] hover:text-[#3FA7D6] transition-colors">
                    {{ $item->title }}
                </a>
            @empty
                <p class="text-sm text-[#0F4C6C]/65">Belum ada press release terbaru.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection

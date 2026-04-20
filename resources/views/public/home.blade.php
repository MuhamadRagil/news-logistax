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

<section class="grid lg:grid-cols-12 gap-8 border-b border-stone-200 pb-10">
    <div class="lg:col-span-7">
        @if($featured)
            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Lead Story</p>
            <a href="{{ route('articles.show', $featured->slug) }}" class="block mt-3">
                <h1 class="text-3xl md:text-5xl leading-tight font-semibold text-slate-900">{{ $featured->title }}</h1>
            </a>
            <p class="mt-4 text-slate-600 leading-relaxed text-base md:text-lg max-w-2xl">{{ $featured->excerpt }}</p>
            <div class="mt-5 text-sm text-slate-500 flex gap-4">
                <span>{{ $featured->category?->name }}</span>
                <span>•</span>
                <span>{{ optional($featured->published_at)->format('d M Y') }}</span>
            </div>
        @endif
    </div>

    <div class="lg:col-span-5 space-y-4">
        <h2 class="text-sm uppercase tracking-[0.18em] text-slate-500">Top Stories</h2>
        <div class="space-y-4">
            @foreach($secondary as $item)
                <article class="border-b border-stone-200 pb-4">
                    <p class="text-xs text-slate-500">{{ $item->category?->name }}</p>
                    <a href="{{ route('articles.show', $item->slug) }}" class="block mt-1 font-semibold text-slate-900 hover:text-slate-700">{{ $item->title }}</a>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="grid lg:grid-cols-12 gap-8 mt-10">
    <div class="lg:col-span-8">
        <h2 class="text-xl font-semibold text-slate-900 mb-4">Latest Updates</h2>
        <div class="grid md:grid-cols-2 gap-5">
            @foreach($latestUpdates as $item)
                <article class="bg-white border border-stone-200 p-5">
                    <p class="text-xs uppercase tracking-wide text-slate-500">{{ $item->content_type }}</p>
                    <a href="{{ route('articles.show', $item->slug) }}" class="block mt-2 text-lg font-semibold leading-snug text-slate-900">{{ $item->title }}</a>
                    <p class="mt-2 text-sm text-slate-600 line-clamp-3">{{ $item->excerpt }}</p>
                </article>
            @endforeach
        </div>
    </div>
    <aside class="lg:col-span-4 bg-white border border-stone-200 p-6">
        <h3 class="text-sm uppercase tracking-[0.18em] text-slate-500">Category Focus</h3>
        <div class="mt-4 space-y-6 text-sm">
            <div>
                <p class="font-semibold text-slate-900">Pajak</p>
                @foreach($tax as $item)
                    <a class="block mt-2 text-slate-700 hover:text-slate-900" href="{{ route('articles.show', $item->slug) }}">{{ $item->title }}</a>
                @endforeach
            </div>
            <div>
                <p class="font-semibold text-slate-900">Akuntansi</p>
                @foreach($accounting as $item)
                    <a class="block mt-2 text-slate-700 hover:text-slate-900" href="{{ route('articles.show', $item->slug) }}">{{ $item->title }}</a>
                @endforeach
            </div>
            <div>
                <p class="font-semibold text-slate-900">Hukum</p>
                @foreach($law as $item)
                    <a class="block mt-2 text-slate-700 hover:text-slate-900" href="{{ route('articles.show', $item->slug) }}">{{ $item->title }}</a>
                @endforeach
            </div>
        </div>
    </aside>
</section>

<section class="mt-12 grid md:grid-cols-3 gap-6">
    <div class="bg-white border border-stone-200 p-5">
        <h3 class="text-sm uppercase tracking-[0.15em] text-slate-500">Pengumuman</h3>
        <div class="mt-3 space-y-3">
            @forelse($announcements as $item)
                <a href="{{ route('articles.show', $item->slug) }}" class="block text-sm font-medium text-slate-800 hover:text-slate-900">{{ $item->title }}</a>
            @empty
                <p class="text-sm text-slate-500">Belum ada pengumuman terbaru.</p>
            @endforelse
        </div>
    </div>
    <div class="bg-white border border-stone-200 p-5">
        <h3 class="text-sm uppercase tracking-[0.15em] text-slate-500">Opini</h3>
        <div class="mt-3 space-y-3">
            @forelse($opinions as $item)
                <a href="{{ route('articles.show', $item->slug) }}" class="block text-sm font-medium text-slate-800 hover:text-slate-900">{{ $item->title }}</a>
            @empty
                <p class="text-sm text-slate-500">Belum ada artikel opini terbaru.</p>
            @endforelse
        </div>
    </div>
    <div class="bg-white border border-stone-200 p-5">
        <h3 class="text-sm uppercase tracking-[0.15em] text-slate-500">Press Release</h3>
        <div class="mt-3 space-y-3">
            @forelse($pressReleases as $item)
                <a href="{{ route('articles.show', $item->slug) }}" class="block text-sm font-medium text-slate-800 hover:text-slate-900">{{ $item->title }}</a>
            @empty
                <p class="text-sm text-slate-500">Belum ada press release terbaru.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection

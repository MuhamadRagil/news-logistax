@extends('layouts.public')

@php
    $homeLd = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => 'Logistax Newsroom',
        'url' => route('home'),
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'Logistax Newsroom',
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('images/logo.png'),
            ],
        ],
    ];

    $homeLdJson = json_encode(
        $homeLd,
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
    );
@endphp

@section('title', 'Logistax Newsroom')
@section('meta_description', 'Portal publikasi resmi Logistax untuk pembaruan perpajakan, akuntansi, hukum, pengumuman institusional, opini, dan press release.')
@section('canonical', route('home'))
@if($featured?->featuredImage)
    @section('og_image', asset('storage/' . $featured->featuredImage->path))
@endif

@section('structured_data')
    <script type="application/ld+json">{!! $homeLdJson !!}</script>
@endsection

@section('content')
@php
    $secondary = $latest->take(4);
    $latestUpdates = $latest->skip(4)->take(6);
    $timeline = $latest->skip(10)->take(14);
    $opinions = $latest->where('content_type', 'opinion')->take(3);
    $releaseHighlights = $latest
        ->whereIn('content_type', ['announcement', 'press_release'])
        ->take(3);
@endphp

<section class="rounded-2xl border border-[#0F4C6C]/10 bg-white overflow-hidden">
    <div class="grid lg:grid-cols-3 gap-8 p-6 md:p-8">
        <div class="lg:col-span-2">
            @if($featured)
                @if($featured->featuredImage)
                    <a href="{{ route('articles.show', $featured->slug) }}" class="block overflow-hidden rounded-xl bg-[#F8FAFC]">
                        <img
                            class="w-full h-[220px] sm:h-[300px] lg:h-[360px] object-cover"
                            src="{{ asset('storage/' . $featured->featuredImage->path) }}"
                            alt="{{ $featured->featuredImage->alt_text ?: $featured->title }}"
                        >
                    </a>
                @endif

                <div class="flex items-center gap-2.5 mt-4">
                    <span class="bg-[#E7F7EE] text-[#16A34A] text-[11px] font-bold uppercase tracking-wide px-2.5 py-1 rounded-full">
                        {{ $featured->category?->name }}
                    </span>
                    <span class="font-mono text-xs text-slate-500">
                        {{ optional($featured->published_at)->translatedFormat('d M Y') }} · {{ optional($featured->published_at)->format('H:i') }} WIB
                    </span>
                </div>

                <a href="{{ route('articles.show', $featured->slug) }}" class="block group">
                    <h1 class="text-2xl md:text-3xl lg:text-[34px] leading-tight font-extrabold text-[#0F172A] tracking-tight mt-3 mb-2.5 group-hover:text-[#0F4C6C] transition-colors">
                        {{ $featured->title }}
                    </h1>
                </a>

                <p class="text-base leading-relaxed text-[#475569] max-w-2xl">
                    {{ $featured->excerpt }}
                </p>
            @else
                <div class="rounded-xl border border-dashed border-[#3FA7D6]/50 bg-[#F8FAFC] p-8">
                    <h1 class="text-2xl md:text-3xl font-extrabold text-[#0F172A]">Belum ada lead story hari ini</h1>
                    <p class="mt-3 text-[#475569]">Tim editorial sedang menyiapkan sorotan utama. Silakan lihat pembaruan terbaru di bawah.</p>
                </div>
            @endif
        </div>

        <div class="flex flex-col">
            <div class="text-xs font-bold uppercase tracking-wide text-[#0F4C6C] mb-3.5">Berita Terkait</div>

            @forelse($secondary as $item)
                <a href="{{ route('articles.show', $item->slug) }}" class="flex gap-3 py-3.5 border-b border-slate-200 last:border-0 group">
                    @if($item->featuredImage)
                        <img
                            class="w-[76px] h-[76px] rounded-lg object-cover shrink-0"
                            src="{{ asset('storage/' . $item->featuredImage->path) }}"
                            alt="{{ $item->featuredImage->alt_text ?: $item->title }}"
                            loading="lazy"
                            decoding="async"
                        >
                    @else
                        <div class="w-[76px] h-[76px] rounded-lg bg-[#F1F5F9] shrink-0"></div>
                    @endif

                    <div class="min-w-0">
                        <span class="{{ $item->content_type_badge_class }} text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 rounded-full">
                            {{ $item->content_type_label }}
                        </span>
                        <div class="text-sm font-bold text-[#0F172A] leading-snug mt-1.5 group-hover:text-[#0F4C6C] transition-colors">
                            {{ $item->title }}
                        </div>
                        <div class="font-mono text-[11px] text-slate-400 mt-1">
                            {{ optional($item->published_at)->format('H:i') }} WIB
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-sm text-[#475569]">Belum ada berita terkait untuk ditampilkan.</p>
            @endforelse
        </div>
    </div>
</section>

<section class="mt-8">
    <h2 class="text-[19px] font-extrabold text-[#0F172A] tracking-tight mb-3.5">Kategori Pilihan</h2>

    <div class="flex items-start gap-6 sm:gap-8 overflow-x-auto pb-1">
        @php
            $categoryIcons = ['pajak' => 'document', 'akuntansi' => 'chart', 'hukum' => 'scale'];
            $colorCycle = [['#E8F5FB', '#0F4C6C'], ['#E7F7EE', '#16A34A'], ['#F1EAFE', '#7C3AED']];

            $categoryShortcuts = $categories->take(3)->values()->map(function ($category, $index) use ($categoryIcons, $colorCycle) {
                [$bg, $fg] = $colorCycle[$index % count($colorCycle)];

                return [
                    'label' => $category->name,
                    'href' => route('categories.show', $category->slug),
                    'bg' => $bg,
                    'fg' => $fg,
                    'icon' => $categoryIcons[$category->slug] ?? 'document',
                ];
            });

            $shortcuts = $categoryShortcuts->concat([
                ['label' => 'Pengumuman', 'href' => route('home') . '#pengumuman', 'bg' => '#FEF3E2', 'fg' => '#D97706', 'icon' => 'megaphone'],
                ['label' => 'Opini', 'href' => route('home') . '#opini', 'bg' => '#F1F5F9', 'fg' => '#64748B', 'icon' => 'chat'],
            ]);
        @endphp

        @foreach($shortcuts as $shortcut)
            <a href="{{ $shortcut['href'] }}" class="flex flex-col items-center gap-2 shrink-0 group">
                <span
                    class="flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 rounded-full transition-transform group-hover:scale-105"
                    style="background-color: {{ $shortcut['bg'] }}; color: {{ $shortcut['fg'] }};"
                >
                    @if($shortcut['icon'] === 'document')
                        <svg class="w-6 h-6 sm:w-7 sm:h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z" />
                            <path d="M14 3v5h5M9 13h6M9 17h6" />
                        </svg>
                    @elseif($shortcut['icon'] === 'chart')
                        <svg class="w-6 h-6 sm:w-7 sm:h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 20V10M11 20V4M18 20v-7" />
                            <path d="M3 20h18" />
                        </svg>
                    @elseif($shortcut['icon'] === 'scale')
                        <svg class="w-6 h-6 sm:w-7 sm:h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 3v18M7 21h10" />
                            <path d="M5 7h6M13 7h6" />
                            <path d="M5 7 2.5 12a2.5 2.5 0 0 0 5 0L5 7ZM19 7l-2.5 5a2.5 2.5 0 0 0 5 0L19 7Z" />
                        </svg>
                    @elseif($shortcut['icon'] === 'megaphone')
                        <svg class="w-6 h-6 sm:w-7 sm:h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 11v2a2 2 0 0 0 2 2h1l3 5V4l-3 5H5a2 2 0 0 0-2 2Z" />
                            <path d="M14 8a4 4 0 0 1 0 8M18 5a8 8 0 0 1 0 14" />
                        </svg>
                    @else
                        <svg class="w-6 h-6 sm:w-7 sm:h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 12c0 4.42-4.03 8-9 8a9.86 9.86 0 0 1-4-.8L3 20l1.2-3.6A7.9 7.9 0 0 1 3 12c0-4.42 4.03-8 9-8s9 3.58 9 8Z" />
                            <path d="M8 11h8M8 14h5" />
                        </svg>
                    @endif
                </span>
                <span class="text-xs font-bold text-[#0F172A] group-hover:text-[#0F4C6C] transition-colors whitespace-nowrap">
                    {{ $shortcut['label'] }}
                </span>
            </a>
        @endforeach
    </div>
</section>

<section class="mt-8">
    @include('public.partials.ad-slot')
</section>

<section class="mt-8 grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <h2 class="text-[19px] font-extrabold text-[#0F172A] tracking-tight mb-3.5">Berita Terbaru</h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3.5">
            @forelse($latestUpdates as $item)
                <a
                    href="{{ route('articles.show', $item->slug) }}"
                    class="block bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm hover:border-[#3FA7D6]/60 transition-colors"
                >
                    @if($item->featuredImage)
                        <img
                            class="w-full h-[100px] object-cover"
                            src="{{ asset('storage/' . $item->featuredImage->path) }}"
                            alt="{{ $item->featuredImage->alt_text ?: $item->title }}"
                            loading="lazy"
                            decoding="async"
                        >
                    @else
                        <div class="w-full h-[100px] bg-[#F1F5F9]"></div>
                    @endif

                    <div class="p-3">
                        <span class="{{ $item->content_type_badge_class }} text-[9px] font-bold uppercase tracking-wide px-[7px] py-0.5 rounded-full">
                            {{ $item->content_type_label }}
                        </span>

                        <div class="text-[13px] font-bold text-[#0F172A] leading-snug mt-[7px] min-h-[34px] line-clamp-2">
                            {{ $item->title }}
                        </div>

                        <div class="flex items-center justify-between mt-2 font-mono text-[10px] text-slate-400">
                            <span>{{ optional($item->published_at)->format('H:i') }}</span>
                            <span>{{ $item->read_time_minutes }} menit</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="sm:col-span-2 lg:col-span-3 rounded-xl border border-dashed border-[#3FA7D6]/50 bg-white p-8 text-center">
                    <p class="font-medium text-[#0F172A]">Belum ada pembaruan terbaru.</p>
                    <p class="mt-2 text-sm text-[#475569]">Konten baru akan muncul di sini setelah dipublikasikan.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div>
        <h2 class="text-[19px] font-extrabold text-[#0F172A] tracking-tight mb-3.5">Terpopuler</h2>

        <div class="bg-white border border-slate-200 rounded-2xl px-[18px]">
            @forelse($popular as $item)
                <a href="{{ route('articles.show', $item->slug) }}" class="flex gap-3 items-start py-[13px] border-b border-slate-100 last:border-0 group">
                    <div class="font-mono text-xl font-extrabold text-[#3FA7D6] w-6 shrink-0">
                        {{ sprintf('%02d', $loop->iteration) }}
                    </div>
                    <div>
                        <div class="text-[13px] font-bold text-[#0F172A] leading-snug group-hover:text-[#0F4C6C] transition-colors">
                            {{ $item->title }}
                        </div>
                        <div class="text-[10px] font-semibold text-[#0F4C6C] uppercase tracking-wide mt-1.5">
                            {{ $item->category?->name ?? $item->content_type_label }}
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-sm text-[#475569] py-4">Belum ada data artikel terpopuler.</p>
            @endforelse
        </div>
    </div>
</section>

@if($timeline->isNotEmpty())
    <section class="mt-8">
        <h2 class="text-[19px] font-extrabold text-[#0F172A] tracking-tight mb-3.5">Berita Terkini</h2>

        <div class="bg-white border border-slate-200 rounded-2xl px-5 grid sm:grid-cols-2 gap-x-8">
            @foreach($timeline as $item)
                <a href="{{ route('articles.show', $item->slug) }}" class="flex gap-3 items-center py-2.5 border-b border-slate-100 last:border-0 sm:[&:nth-last-child(2)]:border-0 group">
                    @if($item->featuredImage)
                        <img
                            class="w-14 h-14 rounded-md object-cover shrink-0"
                            src="{{ asset('storage/' . $item->featuredImage->path) }}"
                            alt="{{ $item->featuredImage->alt_text ?: $item->title }}"
                            loading="lazy"
                            decoding="async"
                        >
                    @else
                        <div class="w-14 h-14 rounded-md bg-[#F1F5F9] shrink-0"></div>
                    @endif

                    <div class="min-w-0">
                        <div class="text-[13px] font-bold text-[#0F172A] leading-snug line-clamp-2 group-hover:text-[#0F4C6C] transition-colors">
                            {{ $item->title }}
                        </div>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-[10px] font-bold text-[#0F4C6C] uppercase tracking-wide">{{ $item->category?->name }}</span>
                            <span class="font-mono text-[10px] text-slate-400">{{ optional($item->published_at)->format('H:i') }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
@endif

<section class="mt-8">
    @include('public.partials.ad-slot')
</section>

@if($categoryRows->isNotEmpty())
    @foreach($categoryRows as $row)
        <section class="mt-8">
            <div class="flex items-baseline justify-between mb-3.5">
                <h2 class="text-[19px] font-extrabold text-[#0F172A] tracking-tight">{{ $row['category']->name }}</h2>
                <a href="{{ route('categories.show', $row['category']->slug) }}" class="text-xs font-bold text-[#0F4C6C] hover:text-[#3FA7D6] transition-colors">
                    Lihat semua &rarr;
                </a>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5">
                @foreach($row['articles'] as $item)
                    <a
                        href="{{ route('articles.show', $item->slug) }}"
                        class="block bg-white border border-slate-200 rounded-xl overflow-hidden hover:border-[#3FA7D6]/60 transition-colors"
                    >
                        @if($item->featuredImage)
                            <img
                                class="w-full h-[88px] object-cover"
                                src="{{ asset('storage/' . $item->featuredImage->path) }}"
                                alt="{{ $item->featuredImage->alt_text ?: $item->title }}"
                                loading="lazy"
                                decoding="async"
                            >
                        @else
                            <div class="w-full h-[88px] bg-[#F1F5F9]"></div>
                        @endif

                        <div class="p-3">
                            <div class="text-[13px] font-bold text-[#0F172A] leading-snug min-h-[34px] line-clamp-2">
                                {{ $item->title }}
                            </div>
                            <div class="font-mono text-[10px] text-slate-400 mt-2">
                                {{ optional($item->published_at)->format('H:i') }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endforeach
@endif

<section id="pengumuman" class="mt-8 rounded-2xl bg-[#EEF6FA] p-6 md:p-8 scroll-mt-24">
    <div class="flex items-baseline justify-between mb-4">
        <h2 class="text-xl font-extrabold text-[#0F172A] tracking-tight">Pengumuman &amp; Rilis Pers</h2>
        <a href="{{ route('articles.index') }}" class="text-[13px] font-bold text-[#0F4C6C] hover:text-[#3FA7D6] transition-colors">
            Lihat semua &rarr;
        </a>
    </div>

    <div class="grid md:grid-cols-3 gap-5">
        @forelse($releaseHighlights as $item)
            <a href="{{ route('articles.show', $item->slug) }}" class="block bg-white border border-[#DCEAF1] rounded-2xl p-5 hover:border-[#3FA7D6]/60 transition-colors">
                <span class="{{ $item->content_type_badge_class }} text-[10px] font-bold uppercase tracking-wide px-2 py-1 rounded-full">
                    {{ $item->content_type_label }}
                </span>
                <div class="text-base font-bold text-[#0F172A] leading-snug mt-3">
                    {{ $item->title }}
                </div>
                <p class="text-[13px] text-[#64748B] leading-relaxed mt-2 line-clamp-2">
                    {{ $item->excerpt }}
                </p>
                <div class="font-mono text-[11px] text-slate-400 mt-3.5">
                    {{ optional($item->published_at)->translatedFormat('d M Y') }}
                </div>
            </a>
        @empty
            <div class="md:col-span-3 rounded-xl border border-dashed border-[#3FA7D6]/50 bg-white p-8 text-center text-[#475569]">
                Belum ada pengumuman atau rilis pers terbaru.
            </div>
        @endforelse
    </div>
</section>

<section id="opini" class="mt-8 bg-white border border-[#0F4C6C]/10 rounded-2xl p-5 scroll-mt-24">
    <h3 class="text-sm uppercase tracking-[0.15em] text-[#0F4C6C]/70">Opini</h3>
    <div class="mt-3 space-y-3">
        @forelse($opinions as $item)
            <a href="{{ route('articles.show', $item->slug) }}" class="block text-sm font-medium text-[#0F4C6C] hover:text-[#3FA7D6]">
                {{ $item->title }}
            </a>
        @empty
            <p class="text-sm text-[#0F4C6C]/65">Belum ada artikel opini terbaru.</p>
        @endforelse
    </div>
</section>

<section class="mt-8">
    @include('public.partials.ad-slot')
</section>
@endsection
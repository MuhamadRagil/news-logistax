@extends('layouts.public')

@php
    $metaDescription = $article->meta_description ?: $article->excerpt;
    if ($metaDescription && mb_strlen($metaDescription) > 160) {
        $metaDescription = mb_substr($metaDescription, 0, 157) . '...';
    }

    $newsArticleLd = [
        '@context' => 'https://schema.org',
        '@type' => 'NewsArticle',
        'headline' => $article->title,
        'description' => $metaDescription,
        'datePublished' => optional($article->published_at)->toIso8601String(),
        'dateModified' => optional($article->updated_at ?? $article->published_at)->toIso8601String(),
        'author' => [
            '@type' => 'Person',
            'name' => $article->display_author_name,
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'Logistax Newsroom',
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('images/logo.png'),
            ],
        ],
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => route('articles.show', $article->slug),
        ],
    ];

    if ($article->category) {
        $newsArticleLd['articleSection'] = $article->category->name;
    }

    if ($article->featuredImage) {
        $newsArticleLd['image'] = [asset('storage/' . $article->featuredImage->path)];
    }

    $newsArticleLdJson = json_encode(
        $newsArticleLd,
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
    );
@endphp

@section('title', $article->meta_title ?? $article->title)
@section('meta_description', $metaDescription ?: 'Artikel dari Logistax Newsroom.')
@section('canonical', route('articles.show', $article->slug))
@section('og_type', 'article')
@if($article->published_at)
    @section('og_published_time', $article->published_at->toIso8601String())
@endif
@if($article->featuredImage)
    @section('og_image', asset('storage/' . $article->featuredImage->path))
@endif

@section('structured_data')
    <script type="application/ld+json">{!! $newsArticleLdJson !!}</script>
@endsection

@section('content')
@php
    $paragraphCount = $bodyParagraphs->count();
    $readAlsoPositions = collect();

    if ($readAlso->count() >= 2 && $paragraphCount >= 5) {
        $pos1 = max(1, (int) round($paragraphCount / 3));
        $pos2 = min($paragraphCount - 1, (int) round($paragraphCount * 2 / 3));
        if ($pos2 <= $pos1) {
            $pos2 = $pos1 + 1;
        }
        $readAlsoPositions->put($pos1, $readAlso[0]);
        $readAlsoPositions->put($pos2, $readAlso[1]);
    } elseif ($readAlso->isNotEmpty() && $paragraphCount >= 3) {
        $readAlsoPositions->put((int) ceil($paragraphCount / 2), $readAlso->first());
    }
@endphp

<div class="max-w-6xl mx-auto">
    <nav class="flex items-center gap-1.5 text-xs text-slate-500 mb-4 overflow-x-auto whitespace-nowrap">
        <a href="{{ route('home') }}" class="hover:text-[#0F4C6C] transition-colors">Beranda</a>
        @if($article->category)
            <span>/</span>
            <a href="{{ route('categories.show', $article->category->slug) }}" class="hover:text-[#0F4C6C] transition-colors">
                {{ $article->category->name }}
            </a>
        @endif
        <span>/</span>
        <span class="text-slate-400 truncate">{{ $article->title }}</span>
    </nav>

    <div class="grid lg:grid-cols-3 gap-8 items-start">
        <div class="lg:col-span-2">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 md:p-8">
                <div class="flex items-center gap-2.5">
                    <span class="{{ $article->content_type_badge_class }} text-[11px] font-bold uppercase tracking-wide px-2.5 py-1 rounded-full">
                        {{ $article->content_type_label }}
                    </span>
                    @if($article->category)
                        <a href="{{ route('categories.show', $article->category->slug) }}" class="text-[11px] font-bold uppercase tracking-wide text-[#0F4C6C] hover:text-[#3FA7D6] transition-colors">
                            {{ $article->category->name }}
                        </a>
                    @endif
                </div>

                <h1 class="mt-4 text-2xl md:text-3xl lg:text-[40px] leading-tight font-extrabold text-[#0F172A] tracking-tight">
                    {{ $article->title }}
                </h1>

                @if($article->subtitle)
                    <p class="mt-4 text-lg md:text-xl text-[#475569] max-w-3xl">
                        {{ $article->subtitle }}
                    </p>
                @endif

                <div class="mt-6 flex flex-wrap items-center gap-x-5 gap-y-2 text-sm text-[#475569] border-b border-slate-200 pb-6">
                    <span>
                        Penulis:
                        <strong class="text-[#0F172A]">{{ $article->display_author_name }}</strong>
                    </span>

                    <span class="font-mono text-[13px] text-slate-500">
                        {{ optional($article->published_at)->translatedFormat('d M Y') }} · {{ optional($article->published_at)->format('H:i') }} WIB
                    </span>

                    <span class="font-mono text-[13px] text-slate-500">
                        {{ $article->read_time_minutes }} menit baca
                    </span>

                    <span class="font-mono text-[13px] text-slate-400">
                        {{ number_format((int) $article->view_count, 0, ',', '.') }} views
                    </span>
                </div>

                @if($article->featuredImage)
                    <figure class="mt-8 rounded-xl overflow-hidden border border-slate-200 bg-[#F8FAFC]">
                        <img
                            class="w-full max-h-[480px] object-cover"
                            src="{{ asset('storage/' . $article->featuredImage->path) }}"
                            alt="{{ $article->featuredImage->alt_text ?: $article->title }}"
                        >

                        @if($article->featuredImage->caption || $article->featuredImage->credit)
                            <figcaption class="px-4 py-3 text-xs text-slate-500 border-t border-slate-200 bg-white">
                                {{ $article->featuredImage->caption }}
                                @if($article->featuredImage->credit)
                                    <span class="ml-2">© {{ $article->featuredImage->credit }}</span>
                                @endif
                            </figcaption>
                        @endif
                    </figure>
                @endif

                <div class="mt-10 text-[17px] leading-8 text-[#334155]">
                    @forelse($bodyParagraphs as $index => $paragraph)
                        <p class="mb-5 last:mb-0">{!! nl2br(e($paragraph)) !!}</p>

                        @if($readAlsoPositions->has($index + 1))
                            @php($bacaJugaTarget = $readAlsoPositions->get($index + 1))
                            <div class="my-7 border-l-4 border-[#3FA7D6] bg-[#F0F9FD] rounded-r-lg p-4">
                                <p class="text-[11px] font-bold uppercase tracking-wide text-[#0F4C6C] mb-1.5">Baca Juga</p>
                                <a href="{{ route('articles.show', $bacaJugaTarget->slug) }}" class="text-sm font-bold text-[#0F172A] hover:text-[#0F4C6C] transition-colors leading-snug">
                                    {{ $bacaJugaTarget->title }}
                                </a>
                            </div>
                        @endif
                    @empty
                        {{-- Tidak ada isi body untuk ditampilkan. --}}
                    @endforelse
                </div>

                <div class="mt-10 flex items-start gap-3 rounded-xl border border-slate-200 bg-[#F8FAFC] p-4">
                    <div class="h-10 w-10 rounded-full bg-[#0F4C6C]/10 flex items-center justify-center text-sm font-bold text-[#0F4C6C] shrink-0">
                        {{ mb_substr($article->display_author_name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-[#0F172A]">{{ $article->display_author_name }}</p>
                        <p class="text-xs text-slate-500 mt-0.5">
                            Dipublikasikan {{ optional($article->published_at)->translatedFormat('d M Y') }} untuk Logistax Newsroom
                        </p>
                    </div>
                </div>

                <div class="mt-8 text-sm text-slate-500">
                    Bagikan:
                    <span class="ml-1 text-[#0F172A]">Link artikel resmi Logistax Newsroom</span>
                </div>
            </div>

            @if($previousArticle || $nextArticle)
                <div class="mt-6 grid sm:grid-cols-2 gap-4">
                    @if($previousArticle)
                        <a
                            href="{{ route('articles.show', $previousArticle->slug) }}"
                            class="group flex flex-col justify-center rounded-xl border border-slate-200 bg-white p-4 hover:border-[#3FA7D6]/60 transition-colors"
                        >
                            <span class="text-[11px] font-bold uppercase tracking-wide text-slate-400">&larr; Artikel Sebelumnya</span>
                            <span class="mt-1.5 text-sm font-bold text-[#0F172A] leading-snug line-clamp-2 group-hover:text-[#0F4C6C] transition-colors">
                                {{ $previousArticle->title }}
                            </span>
                        </a>
                    @endif

                    @if($nextArticle)
                        <a
                            href="{{ route('articles.show', $nextArticle->slug) }}"
                            class="group flex flex-col justify-center items-end text-right rounded-xl border border-slate-200 bg-white p-4 hover:border-[#3FA7D6]/60 transition-colors {{ $previousArticle ? '' : 'sm:col-start-2' }}"
                        >
                            <span class="text-[11px] font-bold uppercase tracking-wide text-slate-400">Artikel Selanjutnya &rarr;</span>
                            <span class="mt-1.5 text-sm font-bold text-[#0F172A] leading-snug line-clamp-2 group-hover:text-[#0F4C6C] transition-colors">
                                {{ $nextArticle->title }}
                            </span>
                        </a>
                    @endif
                </div>
            @endif
        </div>

        <aside class="lg:col-span-1 lg:sticky lg:top-[210px] self-start space-y-6">
            <div>
                <h2 class="text-[15px] font-extrabold text-[#0F172A] tracking-tight mb-3">Terpopuler</h2>

                <div class="bg-white border border-slate-200 rounded-2xl px-[18px]">
                    @forelse($popular as $item)
                        <a href="{{ route('articles.show', $item->slug) }}" class="flex gap-3 items-start py-[13px] border-b border-slate-100 last:border-0 group">
                            <div class="font-mono text-lg font-extrabold text-[#3FA7D6] w-6 shrink-0">
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

            @include('public.partials.ad-slot')

            @if($article->tags->isNotEmpty())
                <div>
                    <h2 class="text-[15px] font-extrabold text-[#0F172A] tracking-tight mb-3">Tag Terkait</h2>

                    <div class="bg-white border border-slate-200 rounded-2xl p-4 flex flex-wrap gap-2">
                        @foreach($article->tags as $tag)
                            <span class="px-3 py-1.5 rounded-full bg-[#0F4C6C]/5 border border-[#0F4C6C]/15 text-[#0F4C6C] text-xs font-semibold">
                                #{{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            @include('public.partials.ad-slot')

            @if($article->category)
                <div>
                    <h2 class="text-[15px] font-extrabold text-[#0F172A] tracking-tight mb-3">
                        Artikel Lain dari {{ $article->category->name }}
                    </h2>

                    <div class="bg-white border border-slate-200 rounded-2xl px-[18px]">
                        @forelse($categoryOthers as $item)
                            <a href="{{ route('articles.show', $item->slug) }}" class="block py-3 border-b border-slate-100 last:border-0 group">
                                <div class="text-[13px] font-bold text-[#0F172A] leading-snug group-hover:text-[#0F4C6C] transition-colors line-clamp-2">
                                    {{ $item->title }}
                                </div>
                                <div class="font-mono text-[10px] text-slate-400 mt-1.5">
                                    {{ optional($item->published_at)->format('d M Y') }}
                                </div>
                            </a>
                        @empty
                            <p class="text-sm text-[#475569] py-4">Belum ada artikel lain untuk ditampilkan.</p>
                        @endforelse
                    </div>
                </div>
            @endif

            @include('public.partials.ad-slot')
        </aside>
    </div>

    <section class="mt-8">
        <div class="flex items-baseline justify-between mb-3.5">
            <h2 class="text-[19px] font-extrabold text-[#0F172A] tracking-tight">Artikel Terkait</h2>
            @if($article->category)
                <a href="{{ route('categories.show', $article->category->slug) }}" class="text-xs font-bold text-[#0F4C6C] hover:text-[#3FA7D6] transition-colors">
                    Lihat semua &rarr;
                </a>
            @endif
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5">
            @forelse($related as $item)
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
                            {{ optional($item->published_at)->format('d M Y') }}
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-2 lg:col-span-4 rounded-xl border border-dashed border-[#3FA7D6]/50 bg-white p-8 text-center text-slate-500">
                    Belum ada artikel terkait untuk ditampilkan.
                </div>
            @endforelse
        </div>
    </section>

    @if($recommended->isNotEmpty())
        <section class="mt-8 rounded-2xl bg-[#F7FAFC] border border-slate-200 p-6 md:p-8">
            <h2 class="text-[19px] font-extrabold text-[#0F172A] tracking-tight mb-4">Rekomendasi Untuk Anda</h2>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5">
                @foreach($recommended as $item)
                    <a
                        href="{{ route('articles.show', $item->slug) }}"
                        class="block bg-white border border-slate-200 rounded-lg overflow-hidden hover:border-[#3FA7D6]/60 transition-colors"
                    >
                        @if($item->featuredImage)
                            <img
                                class="w-full h-[72px] object-cover"
                                src="{{ asset('storage/' . $item->featuredImage->path) }}"
                                alt="{{ $item->featuredImage->alt_text ?: $item->title }}"
                                loading="lazy"
                                decoding="async"
                            >
                        @else
                            <div class="w-full h-[72px] bg-[#F1F5F9]"></div>
                        @endif

                        <div class="p-2.5">
                            <span class="{{ $item->content_type_badge_class }} text-[8px] font-bold uppercase tracking-wide px-1.5 py-0.5 rounded-full">
                                {{ $item->content_type_label }}
                            </span>
                            <div class="text-[12px] font-bold text-[#0F172A] leading-snug mt-1.5 line-clamp-2">
                                {{ $item->title }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection

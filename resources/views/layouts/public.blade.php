<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Logistax News')</title>
    <link rel="icon" type="images/logo.png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAFC] text-[#123247] antialiased">

<header class="sticky top-0 z-30 border-b border-[#0F4C6C]/15 bg-white/95 backdrop-blur-sm">
    <div class="h-1 w-full bg-gradient-to-r from-[#0F4C6C] via-[#3FA7D6] to-[#0F4C6C]"></div>

    @if(($tickerArticles ?? collect())->isNotEmpty())
        <div class="bg-[#0F4C6C] text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center gap-3 py-1.5">
                <span class="shrink-0 inline-flex items-center gap-1.5 rounded-full bg-white/15 px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wide">
                    <svg class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M11 2 3.5 11.5H9L8 18l7.5-9.5H10l1-6.5Z" />
                    </svg>
                    Terkini
                </span>

                <div class="relative flex-1 overflow-hidden">
                    <ul class="flex items-center gap-10 whitespace-nowrap animate-ticker">
                        @foreach($tickerArticles->concat($tickerArticles) as $item)
                            <li>
                                <a href="{{ route('articles.show', $item->slug) }}" class="text-sm text-white/90 hover:text-white transition-colors">
                                    {{ $item->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-2.5 text-xs text-[#0F4C6C]/70 flex items-center justify-between">
            <span>{{ now()->format('l, d F Y') }}</span>
            <span class="hidden sm:inline">Official Publication Portal</span>
            <span class="sm:hidden">Logistax Portal</span>
        </div>

        <div class="py-4 flex items-center justify-between gap-4 border-t border-[#0F4C6C]/10">
            <a href="{{ route('home') }}" class="group flex items-center gap-3 min-w-0">
                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="Logistax"
                    class="h-10 w-auto md:h-11 object-contain"
                >
            </a>

            <div class="flex items-center gap-1">
                <a
                    href="{{ route('search.index') }}"
                    aria-label="Pencarian"
                    class="p-2.5 rounded-full text-[#0F4C6C] hover:bg-[#F8FAFC] transition-colors"
                >
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <circle cx="9" cy="9" r="6" />
                        <path d="m17 17-3.5-3.5" stroke-linecap="round" />
                    </svg>
                </a>

                <button
                    type="button"
                    data-mobile-menu-toggle
                    aria-controls="mobile-nav"
                    aria-expanded="false"
                    aria-label="Buka menu"
                    class="md:hidden p-2.5 rounded-full text-[#0F4C6C] hover:bg-[#F8FAFC] transition-colors"
                >
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M3 5h14M3 10h14M3 15h14" stroke-linecap="round" />
                    </svg>
                </button>
            </div>
        </div>

        <nav class="hidden md:flex items-center gap-1 text-sm font-medium text-[#0F4C6C] border-t border-[#0F4C6C]/10 overflow-x-auto">
            <a
                class="px-3 py-2.5 rounded-full hover:bg-[#F8FAFC] hover:text-[#0F4C6C] transition-all duration-200 relative after:absolute after:left-3 after:right-3 after:-bottom-0.5 after:h-px after:bg-[#3FA7D6] after:scale-x-0 hover:after:scale-x-100 after:transition-transform"
                href="{{ route('articles.index') }}"
            >
                Semua Artikel
            </a>
            @foreach(($navCategories ?? collect()) as $category)
                <a
                    class="px-3 py-2.5 rounded-full hover:bg-[#F8FAFC] hover:text-[#0F4C6C] transition-all duration-200 relative after:absolute after:left-3 after:right-3 after:-bottom-0.5 after:h-px after:bg-[#3FA7D6] after:scale-x-0 hover:after:scale-x-100 after:transition-transform whitespace-nowrap"
                    href="{{ route('categories.show', $category->slug) }}"
                >
                    {{ $category->name }}
                </a>
            @endforeach
            <a
                class="px-3 py-2.5 rounded-full hover:bg-[#F8FAFC] hover:text-[#0F4C6C] transition-all duration-200 relative after:absolute after:left-3 after:right-3 after:-bottom-0.5 after:h-px after:bg-[#3FA7D6] after:scale-x-0 hover:after:scale-x-100 after:transition-transform"
                href="{{ route('pages.show', 'about') }}"
            >
                Tentang
            </a>
            <a
                class="px-3 py-2.5 rounded-full hover:bg-[#F8FAFC] hover:text-[#0F4C6C] transition-all duration-200 relative after:absolute after:left-3 after:right-3 after:-bottom-0.5 after:h-px after:bg-[#3FA7D6] after:scale-x-0 hover:after:scale-x-100 after:transition-transform"
                href="{{ route('pages.show', 'contact') }}"
            >
                Kontak
            </a>
        </nav>

        @if(($trendingTags ?? collect())->isNotEmpty())
            <div class="hidden md:flex items-center gap-2 text-xs pb-3 pt-2 overflow-x-auto">
                <span class="shrink-0 text-[#0F4C6C]/60 font-medium">Trending:</span>
                @foreach($trendingTags as $tag)
                    <a
                        href="{{ route('search.index', ['q' => $tag->name]) }}"
                        class="shrink-0 rounded-full border border-[#3FA7D6]/40 bg-[#3FA7D6]/5 px-3 py-1 text-[#0F4C6C] hover:bg-[#3FA7D6]/15 transition-colors whitespace-nowrap"
                    >
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        @endif

        <nav id="mobile-nav" data-mobile-menu class="hidden md:hidden pb-4 pt-3 space-y-1 text-sm font-medium text-[#0F4C6C] border-t border-[#0F4C6C]/10">
            <a href="{{ route('articles.index') }}" class="block px-3 py-2 rounded-lg hover:bg-[#F8FAFC]">Semua Artikel</a>
            @foreach(($navCategories ?? collect()) as $category)
                <a href="{{ route('categories.show', $category->slug) }}" class="block px-3 py-2 rounded-lg hover:bg-[#F8FAFC]">{{ $category->name }}</a>
            @endforeach
            <a href="{{ route('pages.show', 'about') }}" class="block px-3 py-2 rounded-lg hover:bg-[#F8FAFC]">Tentang</a>
            <a href="{{ route('pages.show', 'contact') }}" class="block px-3 py-2 rounded-lg hover:bg-[#F8FAFC]">Kontak</a>

            @if(($trendingTags ?? collect())->isNotEmpty())
                <div class="flex flex-wrap gap-2 px-3 pt-3">
                    @foreach($trendingTags as $tag)
                        <a
                            href="{{ route('search.index', ['q' => $tag->name]) }}"
                            class="rounded-full border border-[#3FA7D6]/40 bg-[#3FA7D6]/5 px-3 py-1 text-xs text-[#0F4C6C] hover:bg-[#3FA7D6]/15 transition-colors"
                        >
                            #{{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            @endif
        </nav>
    </div>
</header>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-10">
    <div class="h-px w-full bg-[#3FA7D6]/20 mb-6"></div>
    @yield('content')
</main>

<footer class="mt-16 bg-[#0F4C6C] text-white">
    <div class="h-1 w-full bg-[#3FA7D6]"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid sm:grid-cols-2 lg:grid-cols-5 gap-8 text-sm">
        <div class="sm:col-span-2 lg:col-span-1">
            <h3 class="font-semibold text-white text-base">Logistax Newsroom</h3>
            <p class="text-white/80 mt-3 leading-relaxed">
                Portal publikasi resmi Logistax untuk pembaruan perpajakan, akuntansi, hukum,
                pengumuman institusional, opini, dan press release.
            </p>
        </div>

        <div>
            <h4 class="font-semibold text-white">Kategori</h4>
            <ul class="mt-3 space-y-2 text-white/85">
                @forelse(($navCategories ?? collect())->take(6) as $category)
                    <li>
                        <a class="hover:text-[#3FA7D6] transition-colors" href="{{ route('categories.show', $category->slug) }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @empty
                    <li class="text-white/60">Belum ada kategori aktif.</li>
                @endforelse
            </ul>
        </div>

        <div>
            <h4 class="font-semibold text-white">Navigasi</h4>
            <ul class="mt-3 space-y-2 text-white/85">
                <li>
                    <a class="hover:text-[#3FA7D6] transition-colors" href="{{ route('articles.index') }}">
                        Semua Artikel
                    </a>
                </li>
                <li>
                    <a class="hover:text-[#3FA7D6] transition-colors" href="{{ route('search.index') }}">
                        Pencarian
                    </a>
                </li>
                <li>
                    <a class="hover:text-[#3FA7D6] transition-colors" href="{{ route('pages.show', 'about') }}">
                        Tentang
                    </a>
                </li>
                <li>
                    <a class="hover:text-[#3FA7D6] transition-colors" href="{{ route('pages.show', 'contact') }}">
                        Kontak
                    </a>
                </li>
            </ul>
        </div>

        <div>
            <h4 class="font-semibold text-white">Kebijakan</h4>
            <ul class="mt-3 space-y-2 text-white/85">
                <li>
                    <a class="hover:text-[#3FA7D6] transition-colors" href="{{ route('pages.show', 'editorial-policy') }}">
                        Kebijakan Editorial
                    </a>
                </li>
                <li>
                    <a class="hover:text-[#3FA7D6] transition-colors" href="{{ route('pages.show', 'privacy-policy') }}">
                        Kebijakan Privasi
                    </a>
                </li>
            </ul>
        </div>

        <div>
            <h4 class="font-semibold text-white">Kredibilitas Editorial</h4>
            <p class="mt-3 text-white/80 leading-relaxed">
                Seluruh konten melewati proses review internal sebelum dipublikasikan untuk menjaga
                akurasi, kepatuhan, dan kualitas informasi.
            </p>
        </div>
    </div>

    <div class="border-t border-white/20 py-4 text-center text-xs text-white/70">
        © {{ date('Y') }} Logistax. All rights reserved.
    </div>
</footer>

</body>
</html>
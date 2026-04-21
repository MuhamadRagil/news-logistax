<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Logistax News')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAFC] text-[#123247] antialiased">
<header class="sticky top-0 z-30 border-b border-[#0F4C6C]/15 bg-white/95 backdrop-blur-sm">
    <div class="h-0.5 w-full bg-[#3FA7D6]/70"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-2.5 text-xs text-[#0F4C6C]/70 flex items-center justify-between">
            <span>{{ now()->format('l, d F Y') }}</span>
            <span class="hidden sm:inline">Official Publication Portal</span>
            <span class="sm:hidden">Logistax Portal</span>
        </div>

        <div class="py-4 flex items-center justify-between gap-4 border-t border-[#0F4C6C]/10">
            <a href="{{ route('home') }}" class="leading-tight group">
                <span class="block text-xl md:text-2xl tracking-tight font-semibold text-[#0F4C6C] group-hover:text-[#3FA7D6] transition-colors">
                    Logistax Newsroom
                </span>
                <span class="block text-[11px] uppercase tracking-[0.24em] text-[#0F4C6C]/70 mt-1">
                    Tax · Accounting · Law
                </span>
            </a>

            <nav class="hidden md:flex items-center gap-1 text-sm font-medium text-[#0F4C6C]">
                <a class="px-3 py-2 rounded-full hover:bg-[#F8FAFC] hover:text-[#0F4C6C] transition-colors" href="{{ route('articles.index') }}">Semua Artikel</a>
                <a class="px-3 py-2 rounded-full hover:bg-[#F8FAFC] hover:text-[#0F4C6C] transition-colors" href="{{ route('search.index') }}">Pencarian</a>
                <a class="px-3 py-2 rounded-full hover:bg-[#F8FAFC] hover:text-[#0F4C6C] transition-colors" href="{{ route('pages.show', 'about') }}">Tentang</a>
                <a class="px-3 py-2 rounded-full hover:bg-[#F8FAFC] hover:text-[#0F4C6C] transition-colors" href="{{ route('pages.show', 'contact') }}">Kontak</a>
            </nav>
        </div>
    </div>
</header>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-10">
    <div class="h-px w-full bg-[#3FA7D6]/20 mb-6"></div>
    @yield('content')
</main>

<footer class="mt-16 bg-[#0F4C6C] text-white">
    <div class="h-1 w-full bg-[#3FA7D6]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid md:grid-cols-3 gap-8 text-sm">
        <div>
            <h3 class="font-semibold text-white text-base">Logistax Newsroom</h3>
            <p class="text-white/80 mt-3 leading-relaxed">
                Portal publikasi resmi Logistax untuk pembaruan perpajakan, akuntansi, hukum,
                pengumuman institusional, opini, dan press release.
            </p>
        </div>

        <div>
            <h4 class="font-semibold text-white">Navigasi</h4>
            <ul class="mt-3 space-y-2 text-white/85">
                <li><a class="hover:text-[#3FA7D6] transition-colors" href="{{ route('articles.index') }}">Semua Artikel</a></li>
                <li><a class="hover:text-[#3FA7D6] transition-colors" href="{{ route('pages.show', 'editorial-policy') }}">Kebijakan Editorial</a></li>
                <li><a class="hover:text-[#3FA7D6] transition-colors" href="{{ route('pages.show', 'privacy-policy') }}">Kebijakan Privasi</a></li>
                <li><a class="hover:text-[#3FA7D6] transition-colors" href="{{ route('pages.show', 'contact') }}">Kontak</a></li>
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

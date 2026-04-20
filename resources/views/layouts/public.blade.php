<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Logistax News')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-stone-50 text-slate-800 antialiased">
<header class="border-b border-stone-200 bg-white/95 backdrop-blur-sm sticky top-0 z-30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-2 text-xs text-slate-500 flex items-center justify-between">
            <span>{{ now()->format('l, d F Y') }}</span>
            <span>Official Publication Portal</span>
        </div>
        <div class="py-4 flex items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="leading-tight">
                <span class="block text-xl md:text-2xl tracking-tight font-semibold text-slate-900">Logistax Newsroom</span>
                <span class="block text-xs uppercase tracking-[0.24em] text-slate-500 mt-1">Tax · Accounting · Law</span>
            </a>

            <nav class="hidden md:flex items-center gap-6 text-sm font-medium text-slate-700">
                <a class="hover:text-slate-900" href="{{ route('articles.index') }}">Semua Artikel</a>
                <a class="hover:text-slate-900" href="{{ route('search.index') }}">Pencarian</a>
                <a class="hover:text-slate-900" href="{{ route('pages.show', 'about') }}">Tentang</a>
                <a class="hover:text-slate-900" href="{{ route('pages.show', 'contact') }}">Kontak</a>
            </nav>
        </div>
    </div>
</header>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-10">
    @yield('content')
</main>

<footer class="border-t border-stone-200 bg-white mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid md:grid-cols-3 gap-8 text-sm">
        <div>
            <h3 class="font-semibold text-slate-900">Logistax Newsroom</h3>
            <p class="text-slate-600 mt-3 leading-relaxed">
                Portal publikasi resmi Logistax untuk pembaruan perpajakan, akuntansi, hukum,
                pengumuman institusional, opini, dan press release.
            </p>
        </div>
        <div>
            <h4 class="font-semibold text-slate-900">Navigasi</h4>
            <ul class="mt-3 space-y-2 text-slate-600">
                <li><a class="hover:text-slate-900" href="{{ route('articles.index') }}">Semua Artikel</a></li>
                <li><a class="hover:text-slate-900" href="{{ route('pages.show', 'editorial-policy') }}">Kebijakan Editorial</a></li>
                <li><a class="hover:text-slate-900" href="{{ route('pages.show', 'privacy-policy') }}">Kebijakan Privasi</a></li>
                <li><a class="hover:text-slate-900" href="{{ route('pages.show', 'contact') }}">Kontak</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-semibold text-slate-900">Kredibilitas Editorial</h4>
            <p class="mt-3 text-slate-600 leading-relaxed">
                Seluruh konten melewati proses review internal sebelum dipublikasikan untuk menjaga
                akurasi, kepatuhan, dan kualitas informasi.
            </p>
        </div>
    </div>
    <div class="border-t border-stone-200 py-4 text-center text-xs text-slate-500">
        © {{ date('Y') }} Logistax. All rights reserved.
    </div>
</footer>
</body>
</html>

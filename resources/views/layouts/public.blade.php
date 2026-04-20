<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Logistax News')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-slate-800">
<header class="border-b">
    <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-xl font-bold">Logistax News</a>
        <nav class="space-x-4 text-sm">
            <a href="{{ route('articles.index') }}">Articles</a>
            <a href="{{ route('search.index') }}">Search</a>
            <a href="{{ route('pages.show', 'about') }}">About</a>
            <a href="{{ route('pages.show', 'contact') }}">Contact</a>
        </nav>
    </div>
</header>
<main class="max-w-6xl mx-auto px-4 py-8">
    @yield('content')
</main>
</body>
</html>

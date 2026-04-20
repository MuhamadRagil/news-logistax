<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Logistax Newsroom</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800 antialiased">
<div class="min-h-screen lg:grid lg:grid-cols-[280px_1fr]">
    <aside class="bg-slate-900 text-slate-200 p-6 lg:p-8">
        <div class="mb-8">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">CMS</p>
            <h1 class="mt-2 text-xl font-semibold text-white">Logistax Newsroom</h1>
        </div>

        <nav class="space-y-1 text-sm">
            @php
                $navItems = [
                    ['label' => 'Dashboard', 'route' => 'admin.dashboard'],
                    ['label' => 'Articles', 'route' => 'admin.articles.index'],
                    ['label' => 'Categories', 'route' => 'admin.categories.index'],
                    ['label' => 'Tags', 'route' => 'admin.tags.index'],
                    ['label' => 'Media', 'route' => 'admin.media.index'],
                    ['label' => 'Pages', 'route' => 'admin.pages.index'],
                    ['label' => 'Users', 'route' => 'admin.users.index'],
                    ['label' => 'Settings', 'route' => 'admin.settings.general.edit'],
                ];
            @endphp

            @foreach($navItems as $item)
                <a href="{{ route($item['route']) }}"
                   class="block px-3 py-2.5 {{ request()->routeIs(str_replace('.index', '.*', $item['route'])) || request()->routeIs($item['route']) ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="mt-10 text-xs text-slate-400">
            <p>Logged in as</p>
            <p class="text-slate-200 mt-1">{{ auth()->user()->name }}</p>
            <p class="mt-1">{{ auth()->user()->getRoleNames()->join(', ') }}</p>
        </div>
    </aside>

    <main class="p-4 sm:p-6 lg:p-10">
        <header class="bg-white border border-slate-200 px-5 py-4 sm:px-6 sm:py-5 flex flex-wrap items-center justify-between gap-3 mb-6">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Admin Panel</p>
                <h2 class="text-xl sm:text-2xl font-semibold mt-1">@yield('page_title')</h2>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm px-3 py-2 border border-slate-300 bg-white hover:bg-slate-50">Logout</button>
            </form>
        </header>

        @if(session('success'))
            <div class="mb-6 border border-emerald-300 bg-emerald-50 text-emerald-700 px-4 py-3 text-sm">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="mb-6 border border-rose-300 bg-rose-50 text-rose-700 px-4 py-3 text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Logistax Newsroom</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F4F7FB] text-slate-800 antialiased">
<div class="min-h-screen lg:grid lg:grid-cols-[280px_1fr]">
    <aside class="bg-[#0F4C6C] text-slate-100 p-6 lg:p-8">
        <div class="mb-8">
            <p class="text-xs uppercase tracking-[0.2em] text-white/65">CMS</p>
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
                <a
                    href="{{ route($item['route']) }}"
                    class="block px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs(str_replace('.index', '.*', $item['route'])) || request()->routeIs($item['route']) ? 'bg-white text-[#0F4C6C] font-medium' : 'text-white/85 hover:bg-white/10 hover:text-white' }}"
                >
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="mt-10 text-xs text-white/70 border-t border-white/20 pt-4">
            <p>Logged in as</p>
            <p class="text-white mt-1 font-medium">{{ auth()->user()->name }}</p>
            <p class="mt-1">{{ auth()->user()->getRoleNames()->join(', ') }}</p>
        </div>
    </aside>

    <main class="p-4 sm:p-6 lg:p-10">
        <header class="rounded-xl bg-white border border-slate-200 px-5 py-4 sm:px-6 sm:py-5 flex flex-wrap items-center justify-between gap-3 mb-6 shadow-sm">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-[#0F4C6C]/60">Admin Panel</p>
                <h2 class="text-xl sm:text-2xl font-semibold mt-1 text-[#0F4C6C]">@yield('page_title')</h2>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm px-3 py-2 rounded-lg border border-slate-300 bg-white hover:bg-slate-50 transition-colors">
                    Logout
                </button>
            </form>
        </header>

        @if(session('success'))
            <div class="mb-6 rounded-xl border border-emerald-300 bg-emerald-50 text-emerald-700 px-4 py-3 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 rounded-xl border border-rose-300 bg-rose-50 text-rose-700 px-4 py-3 text-sm">
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

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Logistax Newsroom</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAFC] text-slate-800 antialiased">
<div class="min-h-screen lg:grid lg:grid-cols-[280px_1fr]">
    <aside class="bg-[#0F4C6C] text-slate-100 p-6 lg:p-8">
        <div class="mb-8 flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logistax" class="h-9 w-auto object-contain">
            <div>
                <p class="text-[11px] uppercase tracking-[0.2em] text-white/65">CMS</p>
                <h1 class="text-base font-extrabold text-white tracking-tight">Logistax Newsroom</h1>
            </div>
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
                    class="block px-3 py-2.5 rounded-lg font-semibold transition-colors {{ request()->routeIs(str_replace('.index', '.*', $item['route'])) || request()->routeIs($item['route']) ? 'bg-white text-[#0F4C6C]' : 'text-white/85 hover:bg-white/10 hover:text-white' }}"
                >
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="mt-10 flex items-center gap-3 text-xs text-white/70 border-t border-white/20 pt-4">
            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-white/15 font-bold text-white">
                {{ mb_substr(auth()->user()->name, 0, 1) }}
            </span>
            <div class="min-w-0">
                <p class="truncate font-semibold text-white">{{ auth()->user()->name }}</p>
                <p class="mt-0.5">{{ auth()->user()->getRoleNames()->join(', ') }}</p>
            </div>
        </div>
    </aside>

    <main class="p-4 sm:p-6 lg:p-10">
        <header class="rounded-xl bg-white border border-slate-200 px-5 py-4 sm:px-6 sm:py-5 flex flex-wrap items-center justify-between gap-3 mb-6 shadow-sm">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#0F4C6C]/60">Admin Panel</p>
                <h2 class="text-xl sm:text-2xl font-extrabold tracking-tight mt-1 text-[#0F4C6C]">@yield('page_title')</h2>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm font-semibold px-3 py-2 rounded-lg border border-slate-300 bg-white hover:bg-slate-50 transition-colors">
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

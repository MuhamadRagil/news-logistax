<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Logistax News</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800">
<div class="min-h-screen flex">
    <aside class="w-64 bg-slate-900 text-slate-100 p-6 space-y-3">
        <h1 class="text-lg font-semibold">Logistax CMS</h1>
        <nav class="space-y-2 text-sm">
            <a class="block hover:text-white" href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a class="block hover:text-white" href="{{ route('admin.articles.index') }}">Articles</a>
            <a class="block hover:text-white" href="{{ route('admin.categories.index') }}">Categories</a>
            <a class="block hover:text-white" href="{{ route('admin.tags.index') }}">Tags</a>
            <a class="block hover:text-white" href="{{ route('admin.media.index') }}">Media</a>
            <a class="block hover:text-white" href="{{ route('admin.pages.index') }}">Pages</a>
            <a class="block hover:text-white" href="{{ route('admin.users.index') }}">Users</a>
            <a class="block hover:text-white" href="{{ route('admin.settings.general.edit') }}">Settings</a>
        </nav>
    </aside>

    <main class="flex-1 p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">@yield('page_title')</h2>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm px-3 py-2 rounded bg-slate-200">Logout</button>
            </form>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded border border-emerald-300 bg-emerald-50 text-emerald-700 p-3 text-sm">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="mb-6 rounded border border-rose-300 bg-rose-50 text-rose-700 p-3 text-sm">
                <ul class="list-disc pl-5">
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

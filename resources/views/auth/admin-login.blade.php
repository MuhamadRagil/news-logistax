<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Logistax</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F8FAFC] text-[#123247] antialiased">
<div class="min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md rounded-2xl border border-[#0F4C6C]/15 bg-white p-7 shadow-sm">
        <div class="mb-6">
            <p class="text-xs uppercase tracking-[0.2em] text-[#0F4C6C]/65">Admin Portal</p>
            <h1 class="mt-2 text-2xl font-semibold text-[#0F4C6C]">Masuk CMS Logistax</h1>
            <p class="mt-2 text-sm text-[#0F4C6C]/70">Gunakan akun admin untuk mengakses dashboard editorial.</p>
        </div>

        <form method="POST" action="{{ route('login.store') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-[#0F4C6C]">Email</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="mt-1 w-full rounded-lg border border-[#0F4C6C]/25 px-3 py-2 text-[#0F4C6C] placeholder:text-[#0F4C6C]/45 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
                >
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-[#0F4C6C]">Password</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    class="mt-1 w-full rounded-lg border border-[#0F4C6C]/25 px-3 py-2 text-[#0F4C6C] focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
                >
            </div>

            <label class="inline-flex items-center gap-2 text-sm text-[#0F4C6C]/75">
                <input type="checkbox" name="remember" value="1" class="rounded border-[#0F4C6C]/40 text-[#0F4C6C] focus:ring-[#3FA7D6]/40">
                Ingat saya
            </label>

            @if($errors->any())
                <div class="rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <button type="submit" class="w-full rounded-lg bg-[#0F4C6C] px-4 py-2.5 text-sm font-medium text-white hover:bg-[#0d425d] transition-colors">
                Masuk
            </button>
        </form>
    </div>
</div>
</body>
</html>

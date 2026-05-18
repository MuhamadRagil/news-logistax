<form method="POST" action="{{ $action }}" class="max-w-4xl space-y-6">
    @csrf
    @if(($method ?? 'POST') !== 'POST')
        @method($method)
    @endif

    <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
        <div class="mb-5 border-b border-slate-200 pb-4">
            <h3 class="text-lg font-semibold text-slate-900">Profile Details</h3>
            <p class="mt-1 text-sm text-slate-500">Use an active email address for CMS sign in. Password hashes are never displayed.</p>
        </div>

        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <label for="name" class="mb-1 block text-sm font-medium text-slate-700">Name <span class="text-rose-500">*</span></label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    required
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
                >
            </div>

            <div>
                <label for="email" class="mb-1 block text-sm font-medium text-slate-700">Email <span class="text-rose-500">*</span></label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    required
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
                >
            </div>
        </div>
    </div>

    <div id="role-card" class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
        <div class="mb-5 border-b border-slate-200 pb-4">
            <h3 class="text-lg font-semibold text-slate-900">Role & Status</h3>
            <p class="mt-1 text-sm text-slate-500">Roles are loaded from the existing roles table and applied with Spatie Permission.</p>
        </div>

        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <label for="role" class="mb-1 block text-sm font-medium text-slate-700">Role <span class="text-rose-500">*</span></label>
                <select
                    id="role"
                    name="role"
                    required
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
                >
                    <option value="">Select role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" @selected(old('role', $user->roles->first()?->name) === $role->name)>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            @if($hasIsActiveColumn)
                <div class="flex items-end">
                    <label class="flex w-full items-center gap-3 rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700">
                        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $user->exists ? $user->is_active : true)) class="rounded border-slate-300 text-[#0F4C6C] focus:ring-[#3FA7D6]">
                        <span>
                            <span class="block font-medium text-slate-900">Active user</span>
                            <span class="block text-xs text-slate-500">Uncheck to mark this CMS user inactive.</span>
                        </span>
                    </label>
                </div>
            @endif
        </div>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
        <div class="mb-5 border-b border-slate-200 pb-4">
            <h3 class="text-lg font-semibold text-slate-900">Password</h3>
            <p class="mt-1 text-sm text-slate-500">
                @if($user->exists)
                    Leave password fields blank to keep the current password.
                @else
                    Password must be at least 8 characters.
                @endif
            </p>
        </div>

        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <label for="password" class="mb-1 block text-sm font-medium text-slate-700">Password @unless($user->exists)<span class="text-rose-500">*</span>@endunless</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    @unless($user->exists) required @endunless
                    autocomplete="new-password"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
                >
            </div>

            <div>
                <label for="password_confirmation" class="mb-1 block text-sm font-medium text-slate-700">Confirm Password @unless($user->exists)<span class="text-rose-500">*</span>@endunless</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    @unless($user->exists) required @endunless
                    autocomplete="new-password"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
                >
            </div>
        </div>
    </div>

    <div class="flex flex-wrap gap-3">
        <button type="submit" class="rounded-lg bg-[#0F4C6C] px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-[#0d425d]">{{ $submitLabel }}</button>
        <a href="{{ route('admin.users.index') }}" class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 transition-colors hover:bg-slate-50">Back</a>
    </div>
</form>

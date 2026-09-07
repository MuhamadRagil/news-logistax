@extends('layouts.admin')

@section('title', 'Categories')
@section('page_title', 'Categories')

@section('content')
<div class="mb-4 flex justify-end">
    <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 rounded-lg bg-[#0F4C6C] text-white text-sm font-bold hover:bg-[#0d425d] transition-colors">
        New Category
    </a>
</div>

<div class="rounded-xl bg-white border border-slate-200 overflow-hidden shadow-sm">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-600">
            <tr>
                <th class="px-5 py-3 text-left font-bold">Name</th>
                <th class="px-5 py-3 text-left font-bold">Slug</th>
                <th class="px-5 py-3 text-left font-bold">Status</th>
                <th class="px-5 py-3 text-left font-bold">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr class="border-t border-slate-200 hover:bg-slate-50/70">
                    <td class="px-5 py-3 font-bold text-slate-900">{{ $category->name }}</td>
                    <td class="px-5 py-3 text-slate-600 font-mono">{{ $category->slug }}</td>
                    <td class="px-5 py-3">
                        @if($category->is_active)
                            <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-200">Active</span>
                        @else
                            <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-500 ring-1 ring-slate-200">Inactive</span>
                        @endif
                    </td>
                    <td class="px-5 py-3 font-semibold">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-700 hover:text-blue-900">
                            Edit
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-5 py-6 text-center text-slate-500">
                        No categories found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $categories->links() }}
</div>
@endsection
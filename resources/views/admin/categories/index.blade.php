@extends('layouts.admin')

@section('title', 'Categories')
@section('page_title', 'Categories')

@section('content')
<div class="mb-4 flex justify-end">
    <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 rounded-lg bg-[#0F4C6C] text-white text-sm hover:bg-[#0d425d] transition-colors">
        New Category
    </a>
</div>

<div class="rounded-xl bg-white border border-slate-200 overflow-hidden shadow-sm">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-600">
            <tr>
                <th class="px-5 py-3 text-left font-medium">Name</th>
                <th class="px-5 py-3 text-left font-medium">Slug</th>
                <th class="px-5 py-3 text-left font-medium">Status</th>
                <th class="px-5 py-3 text-left font-medium">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr class="border-t border-slate-200 hover:bg-slate-50/70">
                    <td class="px-5 py-3 font-medium">{{ $category->name }}</td>
                    <td class="px-5 py-3 text-slate-600">{{ $category->slug }}</td>
                    <td class="px-5 py-3">{{ $category->is_active ? 'Active' : 'Inactive' }}</td>
                    <td class="px-5 py-3">
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
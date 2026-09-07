@extends('layouts.admin')

@section('title', 'Pages')
@section('page_title', 'Static Pages')

@section('content')
<div class="rounded-xl bg-white border border-slate-200 overflow-hidden shadow-sm">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-600">
            <tr>
                <th class="px-5 py-3 text-left font-bold">Title</th>
                <th class="px-5 py-3 text-left font-bold">Slug</th>
                <th class="px-5 py-3 text-left font-bold">Status</th>
                <th class="px-5 py-3 text-left font-bold">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pages as $page)
                <tr class="border-t border-slate-200 hover:bg-slate-50/70">
                    <td class="px-5 py-3 font-bold text-slate-900">{{ $page->title }}</td>
                    <td class="px-5 py-3 text-slate-600 font-mono">{{ $page->slug }}</td>
                    <td class="px-5 py-3">
                        @if($page->status === 'published')
                            <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-200">Published</span>
                        @else
                            <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-500 ring-1 ring-slate-200">{{ ucfirst($page->status) }}</span>
                        @endif
                    </td>
                    <td class="px-5 py-3 font-semibold">
                        <a class="text-blue-700 hover:text-blue-900" href="{{ route('admin.pages.edit', $page) }}">
                            Edit
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-5 py-8 text-center text-slate-500">
                        No pages found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
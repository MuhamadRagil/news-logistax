@extends('layouts.admin')

@section('title', 'Pages')
@section('page_title', 'Static Pages')

@section('content')
<div class="bg-white border border-slate-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-600">
            <tr>
                <th class="px-5 py-3 text-left font-medium">Title</th>
                <th class="px-5 py-3 text-left font-medium">Slug</th>
                <th class="px-5 py-3 text-left font-medium">Status</th>
                <th class="px-5 py-3 text-left font-medium">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pages as $page)
                <tr class="border-t border-slate-200">
                    <td class="px-5 py-3 font-medium">{{ $page->title }}</td>
                    <td class="px-5 py-3 text-slate-600">{{ $page->slug }}</td>
                    <td class="px-5 py-3">
                        <span class="px-2.5 py-1 text-xs border border-slate-300 bg-slate-50">
                            {{ $page->status }}
                        </span>
                    </td>
                    <td class="px-5 py-3">
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
@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Editorial Dashboard')

@section('content')
<div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
    @foreach($counts as $label => $count)
        <div class="rounded-xl bg-white border border-slate-200 px-4 py-5 shadow-sm">
            <p class="text-xs uppercase tracking-[0.16em] text-slate-500">
                {{ str_replace('_', ' ', $label) }}
            </p>
            <p class="text-3xl font-semibold text-slate-900 mt-2">
                {{ $count }}
            </p>
        </div>
    @endforeach
</div>

<div class="rounded-xl bg-white border border-slate-200 overflow-hidden shadow-sm">
    <div class="px-5 py-4 border-b border-slate-200">
        <h3 class="font-semibold text-slate-900">Latest Content Activity</h3>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-600">
                <tr>
                    <th class="py-3 px-5 text-left font-medium">Title</th>
                    <th class="py-3 px-5 text-left font-medium">Status</th>
                    <th class="py-3 px-5 text-left font-medium">Author</th>
                    <th class="py-3 px-5 text-left font-medium">Updated</th>
                </tr>
            </thead>
            <tbody>
                @forelse($latest as $article)
                    <tr class="border-t border-slate-200 hover:bg-slate-50/70">
                        <td class="py-3 px-5">
                            <a class="text-slate-900 hover:text-slate-700 font-medium" href="{{ route('admin.articles.edit', $article) }}">
                                {{ $article->title }}
                            </a>
                        </td>
                        <td class="py-3 px-5">
                            <span class="px-2.5 py-1 text-xs rounded-full border border-[#0F4C6C]/20 bg-[#F1F7FB] text-[#0F4C6C]">
                                {{ $article->status }}
                            </span>
                        </td>
                        <td class="py-3 px-5 text-slate-600">{{ $article->author?->name }}</td>
                        <td class="py-3 px-5 text-slate-500">{{ $article->updated_at?->diffForHumans() }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-8 text-center text-slate-500">
                            No activity yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
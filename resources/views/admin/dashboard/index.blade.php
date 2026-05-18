@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Editorial Dashboard')

@section('content')
@php
    $metricCards = [
        ['label' => 'Published Articles', 'value' => $metrics['published'], 'helper' => 'Live in newsroom', 'accent' => 'bg-[#0F4C6C]'],
        ['label' => 'Draft Articles', 'value' => $metrics['draft'], 'helper' => 'In writing', 'accent' => 'bg-slate-500'],
        ['label' => 'Pending Review', 'value' => $metrics['pending_review'], 'helper' => 'Needs editor action', 'accent' => 'bg-amber-500'],
        ['label' => 'Scheduled Articles', 'value' => $metrics['scheduled'], 'helper' => 'Queued for publish', 'accent' => 'bg-[#3FA7D6]'],
        ['label' => 'Total Views', 'value' => $metrics['total_views'], 'helper' => 'All article reads', 'accent' => 'bg-emerald-500'],
        ['label' => 'Media Count', 'value' => $metrics['media'], 'helper' => 'Library assets', 'accent' => 'bg-indigo-500'],
    ];
@endphp

<section class="rounded-2xl border border-[#0F4C6C]/10 bg-gradient-to-r from-[#0F4C6C] to-[#11658C] p-5 sm:p-6 text-white shadow-sm mb-6">
    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">
        <div>
            <p class="text-xs uppercase tracking-[0.22em] text-white/70">Logistax Newsroom</p>
            <h2 class="mt-2 text-2xl font-semibold">Editorial performance overview</h2>
            <p class="mt-2 max-w-2xl text-sm text-white/75">
                Pantau status produksi konten, performa pembaca, dan prioritas editorial dari satu dashboard yang ringan untuk production.
            </p>
        </div>
        <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center justify-center rounded-lg bg-white px-4 py-2 text-sm font-semibold text-[#0F4C6C] hover:bg-[#F1F7FB] transition-colors">
            Create Article
        </a>
    </div>
</section>

<section class="grid sm:grid-cols-2 xl:grid-cols-3 gap-4 mb-6">
    @foreach($metricCards as $card)
        <div class="rounded-2xl bg-white border border-slate-200 p-5 shadow-sm">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-xs uppercase tracking-[0.16em] text-slate-500">{{ $card['label'] }}</p>
                    <p class="mt-3 text-3xl font-semibold text-slate-950">{{ number_format($card['value'], 0, ',', '.') }}</p>
                    <p class="mt-1 text-xs text-slate-500">{{ $card['helper'] }}</p>
                </div>
                <span class="h-10 w-1.5 rounded-full {{ $card['accent'] }}"></span>
            </div>
        </div>
    @endforeach
</section>

<section class="grid xl:grid-cols-3 gap-6">
    <div class="xl:col-span-2 rounded-2xl bg-white border border-slate-200 overflow-hidden shadow-sm">
        <div class="px-5 py-4 border-b border-slate-200 flex items-center justify-between gap-3">
            <div>
                <h3 class="font-semibold text-slate-950">Top 5 Most Viewed Articles</h3>
                <p class="mt-1 text-xs text-slate-500">Artikel published dengan performa pembaca tertinggi.</p>
            </div>
            <span class="text-xs font-medium text-[#0F4C6C] bg-[#F1F7FB] rounded-full px-3 py-1">Views</span>
        </div>

        <div class="divide-y divide-slate-100">
            @forelse($topViewed as $article)
                <div class="p-5 flex flex-col md:flex-row md:items-center md:justify-between gap-3 hover:bg-slate-50/70">
                    <div class="min-w-0">
                        <a class="font-medium text-slate-950 hover:text-[#0F4C6C]" href="{{ route('admin.articles.edit', $article) }}">
                            {{ $article->title }}
                        </a>
                        <p class="mt-1 text-xs text-slate-500">
                            {{ $article->category?->name ?? 'Uncategorized' }} · {{ $article->author?->name ?? 'No author' }} · {{ optional($article->published_at)->format('d M Y') }}
                        </p>
                    </div>
                    <p class="shrink-0 text-sm font-semibold text-[#0F4C6C]">{{ number_format((int) $article->view_count, 0, ',', '.') }} views</p>
                </div>
            @empty
                <div class="p-8 text-center text-sm text-slate-500">Belum ada artikel published untuk dianalisis.</div>
            @endforelse
        </div>
    </div>

    <div class="rounded-2xl bg-white border border-slate-200 p-5 shadow-sm">
        <div class="flex items-center justify-between gap-3">
            <div>
                <h3 class="font-semibold text-slate-950">Workflow Summary</h3>
                <p class="mt-1 text-xs text-slate-500">Draft dan antrean editorial.</p>
            </div>
        </div>

        <div class="mt-5 space-y-3">
            @foreach($workflow as $status => $count)
                <div class="rounded-xl border border-slate-200 bg-slate-50/70 px-4 py-3 flex items-center justify-between">
                    <span class="text-sm font-medium text-slate-700">{{ ucfirst(str_replace('_', ' ', $status)) }}</span>
                    <span class="text-lg font-semibold text-[#0F4C6C]">{{ number_format($count, 0, ',', '.') }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="mt-6 rounded-2xl bg-white border border-slate-200 overflow-hidden shadow-sm">
    <div class="px-5 py-4 border-b border-slate-200">
        <h3 class="font-semibold text-slate-950">Latest Published Articles</h3>
        <p class="mt-1 text-xs text-slate-500">Publikasi terbaru untuk monitoring editorial harian.</p>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-600">
                <tr>
                    <th class="py-3 px-5 text-left font-medium">Title</th>
                    <th class="py-3 px-5 text-left font-medium">Category</th>
                    <th class="py-3 px-5 text-left font-medium">Author</th>
                    <th class="py-3 px-5 text-right font-medium">Views</th>
                    <th class="py-3 px-5 text-left font-medium">Published</th>
                </tr>
            </thead>
            <tbody>
                @forelse($latestPublished as $article)
                    <tr class="border-t border-slate-200 hover:bg-slate-50/70">
                        <td class="py-3 px-5">
                            <a class="text-slate-950 hover:text-[#0F4C6C] font-medium" href="{{ route('admin.articles.edit', $article) }}">
                                {{ $article->title }}
                            </a>
                        </td>
                        <td class="py-3 px-5 text-slate-600">{{ $article->category?->name ?? '-' }}</td>
                        <td class="py-3 px-5 text-slate-600">{{ $article->author?->name ?? '-' }}</td>
                        <td class="py-3 px-5 text-right font-medium text-[#0F4C6C]">{{ number_format((int) $article->view_count, 0, ',', '.') }}</td>
                        <td class="py-3 px-5 text-slate-500">{{ optional($article->published_at)->format('d M Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-8 text-center text-slate-500">No published articles yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection

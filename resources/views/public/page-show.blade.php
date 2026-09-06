@extends('layouts.public')

@section('title', $page->meta_title ?? $page->title)

@section('content')
@php
    $staticPages = [
        'about' => 'Tentang',
        'contact' => 'Kontak',
        'editorial-policy' => 'Kebijakan Editorial',
        'privacy-policy' => 'Kebijakan Privasi',
    ];
    unset($staticPages[$page->slug]);
@endphp

<div class="max-w-4xl mx-auto">
    <nav class="flex items-center gap-1.5 text-xs text-slate-500 mb-4">
        <a href="{{ route('home') }}" class="hover:text-[#0F4C6C] transition-colors">Beranda</a>
        <span>/</span>
        <span class="text-slate-400">{{ $page->title }}</span>
    </nav>

    <article class="rounded-2xl border border-slate-200 bg-white p-6 md:p-8">
        <header class="border-b border-slate-200 pb-6">
            <p class="text-xs font-bold uppercase tracking-wide text-[#0F4C6C]">Informasi Institusional</p>
            <h1 class="mt-2 text-3xl md:text-4xl font-extrabold text-[#0F172A] tracking-tight">{{ $page->title }}</h1>
        </header>

        <div
            class="mt-8 text-[17px] leading-8 text-[#334155]
            [&_p]:mb-5 [&_p:last-child]:mb-0
            [&_h2]:text-2xl [&_h2]:font-extrabold [&_h2]:text-[#0F172A] [&_h2]:mt-8 [&_h2]:mb-3
            [&_h3]:text-xl [&_h3]:font-bold [&_h3]:text-[#0F172A] [&_h3]:mt-6 [&_h3]:mb-2
            [&_a]:text-[#0F4C6C] [&_a]:underline [&_a]:decoration-[#3FA7D6]/40 [&_a:hover]:text-[#3FA7D6]
            [&_strong]:font-bold [&_strong]:text-[#0F172A]
            [&_ul]:list-disc [&_ul]:pl-6 [&_ul]:space-y-2 [&_ul]:mb-5
            [&_ol]:list-decimal [&_ol]:pl-6 [&_ol]:space-y-2 [&_ol]:mb-5
            [&_blockquote]:border-l-4 [&_blockquote]:border-[#3FA7D6] [&_blockquote]:pl-4 [&_blockquote]:italic [&_blockquote]:text-slate-600 [&_blockquote]:my-5
            [&_img]:rounded-xl [&_img]:my-6 [&_img]:max-w-full"
        >
            {!! $page->body !!}
        </div>
    </article>

    @if(!empty($staticPages))
        <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-5">
            <p class="text-xs font-bold uppercase tracking-wide text-[#0F4C6C] mb-3">Halaman Lainnya</p>
            <div class="flex flex-wrap gap-2">
                @foreach($staticPages as $slug => $label)
                    <a
                        href="{{ route('pages.show', $slug) }}"
                        class="rounded-full border border-slate-300 bg-white px-4 py-2 text-sm font-bold text-[#0F172A] hover:border-[#3FA7D6]/70 hover:text-[#0F4C6C] transition-colors"
                    >
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection

@extends('layouts.public')
@section('title', $page->meta_title ?? $page->title)

@section('content')
<article class="max-w-4xl mx-auto">
    <header class="border-b border-stone-200 pb-6">
        <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Informasi Institusional</p>
        <h1 class="mt-2 text-3xl md:text-4xl font-semibold text-slate-900">{{ $page->title }}</h1>
    </header>

    <div class="prose prose-slate max-w-none mt-8 prose-p:leading-8 prose-p:text-[17px] prose-headings:font-semibold">
        {!! $page->body !!}
    </div>
</article>
@endsection

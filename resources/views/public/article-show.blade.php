@extends('layouts.public')
@section('title', $article->meta_title ?? $article->title)
@section('content')
<article class="max-w-3xl">
    <p class="text-sm text-slate-500">{{ $article->category?->name }} • {{ $article->published_at?->format('d M Y') }}</p>
    <h1 class="text-4xl font-bold mt-2">{{ $article->title }}</h1>
    @if($article->subtitle)<p class="text-xl text-slate-600 mt-2">{{ $article->subtitle }}</p>@endif
    @if($article->featuredImage)
        <img class="w-full rounded mt-6" src="{{ asset('storage/'.$article->featuredImage->path) }}" alt="{{ $article->featuredImage->alt_text }}">
    @endif
    <div class="prose max-w-none mt-6">{!! nl2br(e($article->body)) !!}</div>
</article>

<section class="mt-12">
    <h2 class="font-semibold mb-3">Related Articles</h2>
    <div class="space-y-2">
        @foreach($related as $item)
            <a href="{{ route('articles.show', $item->slug) }}" class="block text-blue-700">{{ $item->title }}</a>
        @endforeach
    </div>
</section>
@endsection

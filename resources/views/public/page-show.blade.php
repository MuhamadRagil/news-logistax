@extends('layouts.public')
@section('title', $page->meta_title ?? $page->title)
@section('content')
<article class="max-w-3xl prose">
    <h1>{{ $page->title }}</h1>
    {!! $page->body !!}
</article>
@endsection

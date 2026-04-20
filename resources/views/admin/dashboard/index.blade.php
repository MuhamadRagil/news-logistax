@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
    @foreach($counts as $label => $count)
        <div class="bg-white border rounded-lg p-4">
            <p class="text-xs uppercase text-slate-500">{{ str_replace('_', ' ', $label) }}</p>
            <p class="text-2xl font-bold mt-2">{{ $count }}</p>
        </div>
    @endforeach
</div>

<div class="bg-white border rounded-lg p-4">
    <h3 class="font-semibold mb-3">Latest Content Activity</h3>
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left border-b">
                <th class="py-2">Title</th>
                <th>Status</th>
                <th>Author</th>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody>
            @foreach($latest as $article)
                <tr class="border-b">
                    <td class="py-2"><a class="text-blue-700" href="{{ route('admin.articles.edit', $article) }}">{{ $article->title }}</a></td>
                    <td>{{ $article->status }}</td>
                    <td>{{ $article->author?->name }}</td>
                    <td>{{ $article->updated_at?->diffForHumans() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

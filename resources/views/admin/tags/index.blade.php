@extends('layouts.admin')
@section('title', 'Tags')
@section('page_title', 'Tags')
@section('content')
<div class="mb-4"><a href="{{ route('admin.tags.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded text-sm">New Tag</a></div>
<table class="w-full bg-white border rounded text-sm">
    @foreach($tags as $tag)
    <tr class="border-b">
        <td class="p-3">{{ $tag->name }}</td>
        <td>{{ $tag->slug }}</td>
        <td><a href="{{ route('admin.tags.edit', $tag) }}" class="text-blue-700">Edit</a></td>
    </tr>
    @endforeach
</table>
<div class="mt-4">{{ $tags->links() }}</div>
@endsection

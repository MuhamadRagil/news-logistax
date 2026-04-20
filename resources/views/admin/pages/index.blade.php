@extends('layouts.admin')
@section('title', 'Pages')
@section('page_title', 'Pages')
@section('content')
<table class="w-full bg-white border rounded text-sm">
    @foreach($pages as $page)
    <tr class="border-b">
        <td class="p-3">{{ $page->title }}</td>
        <td>{{ $page->slug }}</td>
        <td>{{ $page->status }}</td>
        <td><a class="text-blue-700" href="{{ route('admin.pages.edit', $page) }}">Edit</a></td>
    </tr>
    @endforeach
</table>
@endsection

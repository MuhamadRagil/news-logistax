@extends('layouts.admin')
@section('title', 'Categories')
@section('page_title', 'Categories')
@section('content')
<div class="mb-4"><a href="{{ route('admin.categories.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded text-sm">New Category</a></div>
<table class="w-full bg-white border rounded text-sm">
    @foreach($categories as $category)
    <tr class="border-b">
        <td class="p-3">{{ $category->name }}</td>
        <td>{{ $category->slug }}</td>
        <td><a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-700">Edit</a></td>
    </tr>
    @endforeach
</table>
<div class="mt-4">{{ $categories->links() }}</div>
@endsection

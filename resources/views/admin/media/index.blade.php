@extends('layouts.admin')
@section('title', 'Media')
@section('page_title', 'Media')
@section('content')
<form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data" class="bg-white border rounded p-4 mb-6 grid md:grid-cols-2 gap-3">
    @csrf
    <input type="file" name="image" class="border rounded px-2 py-2" required>
    <input type="text" name="alt_text" class="border rounded px-2 py-2" placeholder="Alt text">
    <input type="text" name="credit" class="border rounded px-2 py-2" placeholder="Credit">
    <textarea name="caption" class="border rounded px-2 py-2" placeholder="Caption"></textarea>
    <button class="px-4 py-2 bg-blue-600 text-white rounded w-fit">Upload</button>
</form>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    @foreach($media as $item)
        <div class="bg-white border rounded p-2">
            <img src="{{ asset('storage/'.$item->path) }}" alt="{{ $item->alt_text }}" class="w-full h-28 object-cover rounded">
            <p class="text-xs mt-2 truncate">{{ $item->filename }}</p>
            <form method="POST" action="{{ route('admin.media.destroy', $item) }}" class="mt-2">
                @csrf @method('DELETE')
                <button class="text-xs text-rose-700">Delete</button>
            </form>
        </div>
    @endforeach
</div>
<div class="mt-4">{{ $media->links() }}</div>
@endsection

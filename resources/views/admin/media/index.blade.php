@extends('layouts.admin')

@section('title', 'Media')
@section('page_title', 'Media Library')

@section('content')
<div class="rounded-xl bg-white border border-slate-200 p-5 sm:p-6 shadow-sm mb-6">
    <h3 class="text-sm uppercase tracking-[0.16em] text-slate-500 mb-4">Upload Image</h3>

    <form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data" class="grid md:grid-cols-2 gap-4">
        @csrf

        <input
            type="file"
            name="image"
            class="rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
            required
        >

        <input
            type="text"
            name="alt_text"
            class="rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
            placeholder="Alt text"
        >

        <input
            type="text"
            name="credit"
            class="rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
            placeholder="Credit"
        >

        <textarea
            name="caption"
            class="rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#3FA7D6]/40"
            placeholder="Caption"
        ></textarea>

        <button class="px-4 py-2 rounded-lg bg-[#0F4C6C] text-white w-fit hover:bg-[#0d425d] transition-colors">
            Upload
        </button>
    </form>
</div>

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
    @foreach($media as $item)
        <div class="rounded-xl bg-white border border-slate-200 p-3 shadow-sm">
            <img
                src="{{ asset('storage/' . $item->path) }}"
                alt="{{ $item->alt_text }}"
                class="w-full h-36 object-cover bg-slate-100 rounded-lg"
            >

            <p class="text-xs mt-3 truncate text-slate-700">
                {{ $item->filename }}
            </p>

            <p class="text-[11px] text-slate-500 mt-1 truncate">
                {{ $item->credit }}
            </p>

            <form
                method="POST"
                action="{{ route('admin.media.destroy', $item) }}"
                class="mt-3"
                onsubmit="return confirm('Delete this media file?')"
            >
                @csrf
                @method('DELETE')

                <button class="text-xs text-rose-700 hover:text-rose-900">
                    Delete
                </button>
            </form>
        </div>
    @endforeach
</div>

<div class="mt-6">
    {{ $media->links() }}
</div>
@endsection
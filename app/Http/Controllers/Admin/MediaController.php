<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MediaStoreRequest;
use App\Models\Media;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:media.manage');
    }

    public function index(): View
    {
        $media = Media::latest()->paginate(24);

        return view('admin.media.index', compact('media'));
    }

    public function store(MediaStoreRequest $request): RedirectResponse
    {
        $file = $request->file('image');

        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();

        // Folder public aktif subdomain cPanel
        $destination = '/home/logistax/news.logistax.id/storage/uploads/articles';

        if (! File::exists($destination)) {
            File::makeDirectory($destination, 0755, true);
        }

        $file->move($destination, $filename);

        // Tetap simpan path relatif agar URL tetap /storage/uploads/articles/...
        $path = 'uploads/articles/' . $filename;

        Media::create([
            'disk' => 'public',
            'path' => $path,
            'filename' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'size_bytes' => File::size($destination . '/' . $filename),
            'alt_text' => $request->input('alt_text'),
            'caption' => $request->input('caption'),
            'credit' => $request->input('credit'),
            'uploaded_by' => auth()->id(),
        ]);

        return back()->with('success', 'Image uploaded.');
    }

    public function destroy(Media $medium): RedirectResponse
    {
        $filePath = '/home/logistax/news.logistax.id/storage/' . $medium->path;

        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $medium->delete();

        return back()->with('success', 'Image deleted.');
    }
}
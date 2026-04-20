<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\View\View;

class PageController extends Controller
{
    public function show(string $slug): View
    {
        $page = Page::query()
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('public.page-show', compact('page'));
    }
}

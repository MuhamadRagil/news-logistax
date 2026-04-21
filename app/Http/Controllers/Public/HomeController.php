<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $featured = Article::query()
            ->where('status', Article::STATUS_PUBLISHED)
            ->where('is_featured', true)
            ->latest('published_at')
            ->first();

        $latest = Article::query()
            ->where('status', Article::STATUS_PUBLISHED)
            ->when($featured, fn ($query) => $query->where('id', '!=', $featured->id))
            ->latest('published_at')
            ->limit(24)
            ->get();

        $categories = Category::query()->where('is_active', true)->orderBy('sort_order')->get();

        return view('public.home', compact('featured', 'latest', 'categories'));
    }
}

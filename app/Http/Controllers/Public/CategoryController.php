<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function show(string $slug): View
    {
        $category = Category::query()->where('slug', $slug)->where('is_active', true)->firstOrFail();

        $articles = Article::query()->with(['category', 'featuredImage'])->where('status', Article::STATUS_PUBLISHED)
            ->where('category_id', $category->id)
            ->latest('published_at')
            ->paginate(12);

        return view('public.category-show', compact('category', 'articles'));
    }
}

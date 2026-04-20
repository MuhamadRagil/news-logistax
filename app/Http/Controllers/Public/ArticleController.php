<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(Request $request): View
    {
        $query = Article::query()->where('status', Article::STATUS_PUBLISHED)->with(['category', 'author']);

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->string('category')));
        }

        if ($request->filled('q')) {
            $term = $request->string('q');
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', "%{$term}%")
                    ->orWhere('excerpt', 'like', "%{$term}%")
                    ->orWhere('body', 'like', "%{$term}%");
            });
        }

        $articles = $query->latest('published_at')->paginate(12)->withQueryString();
        $categories = Category::query()->where('is_active', true)->orderBy('name')->get();

        return view('public.articles-index', compact('articles', 'categories'));
    }

    public function show(string $slug): View
    {
        $article = Article::query()->with(['category', 'author', 'tags', 'featuredImage'])
            ->where('status', Article::STATUS_PUBLISHED)
            ->where('slug', $slug)
            ->firstOrFail();

        $related = Article::query()->where('status', Article::STATUS_PUBLISHED)
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->limit(4)
            ->get();

        return view('public.article-show', compact('article', 'related'));
    }
}

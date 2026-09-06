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
        $query = Article::query()->where('status', Article::STATUS_PUBLISHED)->with(['category', 'author', 'featuredImage']);

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

        Article::query()
            ->whereKey($article->getKey())
            ->where('status', Article::STATUS_PUBLISHED)
            ->increment('view_count');

        $article->view_count = ((int) $article->view_count) + 1;

        $bodyParagraphs = collect(preg_split('/\r?\n\s*\r?\n/', trim((string) $article->body)))
            ->map(fn ($paragraph) => trim($paragraph))
            ->filter()
            ->values();

        // Every list on this page must show distinct articles, so each query below
        // excludes everything already claimed by a higher-priority section.
        $usedIds = collect([$article->id]);

        $previousArticle = Article::query()
            ->where('status', Article::STATUS_PUBLISHED)
            ->where('category_id', $article->category_id)
            ->where('published_at', '<', $article->published_at)
            ->latest('published_at')
            ->first();

        $nextArticle = Article::query()
            ->where('status', Article::STATUS_PUBLISHED)
            ->where('category_id', $article->category_id)
            ->where('published_at', '>', $article->published_at)
            ->oldest('published_at')
            ->first();

        $usedIds = $usedIds->merge(collect([$previousArticle?->id, $nextArticle?->id])->filter());

        $readAlsoLimit = match (true) {
            $bodyParagraphs->count() >= 5 => 2,
            $bodyParagraphs->count() >= 3 => 1,
            default => 0,
        };

        $readAlso = $readAlsoLimit > 0
            ? Article::query()
                ->where('status', Article::STATUS_PUBLISHED)
                ->where('category_id', $article->category_id)
                ->whereNotIn('id', $usedIds)
                ->latest('published_at')
                ->limit($readAlsoLimit)
                ->get()
            : collect();

        $usedIds = $usedIds->merge($readAlso->pluck('id'));

        $categoryOthers = Article::query()->with('featuredImage')
            ->where('status', Article::STATUS_PUBLISHED)
            ->where('category_id', $article->category_id)
            ->whereNotIn('id', $usedIds)
            ->latest('published_at')
            ->limit(6)
            ->get();

        $usedIds = $usedIds->merge($categoryOthers->pluck('id'));

        $related = Article::query()->with(['category', 'featuredImage'])
            ->where('status', Article::STATUS_PUBLISHED)
            ->where('category_id', $article->category_id)
            ->whereNotIn('id', $usedIds)
            ->latest('published_at')
            ->limit(8)
            ->get();

        if ($related->count() < 8) {
            $fallback = Article::query()->with(['category', 'featuredImage'])
                ->where('status', Article::STATUS_PUBLISHED)
                ->whereNotIn('id', $usedIds->merge($related->pluck('id')))
                ->latest('published_at')
                ->limit(8 - $related->count())
                ->get();

            $related = $related->concat($fallback);
        }

        $usedIds = $usedIds->merge($related->pluck('id'));

        $recommended = Article::query()->with(['category', 'featuredImage'])
            ->where('status', Article::STATUS_PUBLISHED)
            ->where('category_id', $article->category_id)
            ->whereNotIn('id', $usedIds)
            ->latest('published_at')
            ->limit(2)
            ->get();

        $usedIds = $usedIds->merge($recommended->pluck('id'));
        $remaining = 4 - $recommended->count();

        if ($remaining > 0) {
            $popularFill = Article::popular(12)->whereNotIn('id', $usedIds)->take($remaining)->values();
            $recommended = $recommended->concat($popularFill);
            $usedIds = $usedIds->merge($popularFill->pluck('id'));
            $remaining = 4 - $recommended->count();
        }

        if ($remaining > 0) {
            $latestFill = Article::query()->with(['category', 'featuredImage'])
                ->where('status', Article::STATUS_PUBLISHED)
                ->whereNotIn('id', $usedIds)
                ->latest('published_at')
                ->limit($remaining)
                ->get();

            $recommended = $recommended->concat($latestFill);
        }

        $popular = Article::popular();

        return view('public.article-show', compact(
            'article',
            'bodyParagraphs',
            'previousArticle',
            'nextArticle',
            'readAlso',
            'categoryOthers',
            'related',
            'recommended',
            'popular'
        ));
    }
}

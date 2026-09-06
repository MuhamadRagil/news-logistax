<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::before(function ($user, string $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });

        View::composer('layouts.public', function ($view): void {
            $navCategories = Category::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get();

            $tickerArticles = Article::query()
                ->where('status', Article::STATUS_PUBLISHED)
                ->latest('published_at')
                ->limit(6)
                ->get(['id', 'title', 'slug', 'published_at']);

            $trendingTags = Tag::query()
                ->withCount(['articles' => function ($query): void {
                    $query->where('status', Article::STATUS_PUBLISHED);
                }])
                ->having('articles_count', '>', 0)
                ->orderByDesc('articles_count')
                ->limit(8)
                ->get();

            $view->with(compact('navCategories', 'tickerArticles', 'trendingTags'));
        });
    }
}

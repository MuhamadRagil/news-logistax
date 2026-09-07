<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;
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
            // Only plain ID arrays are cached, never Eloquent objects: this app's
            // cache config sets `serializable_classes => false` (config/cache.php)
            // to block object unserialization from cache as a hardening against
            // gadget-chain attacks if APP_KEY leaks, so a cached Collection/Model
            // would come back as an unusable __PHP_Incomplete_Class instance.

            $navCategoryIds = Cache::remember('nav.categories.ids', 3600, function () {
                return Category::query()
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->pluck('id')
                    ->all();
            });

            $navCategories = empty($navCategoryIds)
                ? collect()
                : Category::query()->whereIn('id', $navCategoryIds)->orderBy('sort_order')->get();

            // Not cached: breaking-news ticker must always reflect the latest publish.
            $tickerArticles = Article::query()
                ->where('status', Article::STATUS_PUBLISHED)
                ->latest('published_at')
                ->limit(6)
                ->get(['id', 'title', 'slug', 'published_at']);

            $trendingTagIds = Cache::remember('nav.trending_tags.ids', 600, function () {
                return Tag::query()
                    ->withCount(['articles' => function ($query): void {
                        $query->where('status', Article::STATUS_PUBLISHED);
                    }])
                    ->having('articles_count', '>', 0)
                    ->orderByDesc('articles_count')
                    ->limit(8)
                    ->pluck('id')
                    ->all();
            });

            $trendingTagsById = empty($trendingTagIds)
                ? collect()
                : Tag::query()->whereIn('id', $trendingTagIds)->get()->keyBy('id');

            $trendingTags = collect($trendingTagIds)
                ->map(fn ($id) => $trendingTagsById->get($id))
                ->filter()
                ->values();

            $view->with(compact('navCategories', 'tickerArticles', 'trendingTags'));
        });
    }
}

<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = collect([
            [
                'loc' => route('home'),
                'lastmod' => now(),
                'changefreq' => 'hourly',
                'priority' => '1.0',
            ],
            [
                'loc' => route('articles.index'),
                'lastmod' => now(),
                'changefreq' => 'hourly',
                'priority' => '0.8',
            ],
        ]);

        $urls = $urls->concat(
            Category::query()->where('is_active', true)->get()->map(fn (Category $category) => [
                'loc' => route('categories.show', $category->slug),
                'lastmod' => $category->updated_at ?? now(),
                'changefreq' => 'daily',
                'priority' => '0.7',
            ])
        );

        $urls = $urls->concat(
            Page::query()->where('status', 'published')->get()->map(fn (Page $page) => [
                'loc' => route('pages.show', $page->slug),
                'lastmod' => $page->updated_at ?? $page->published_at ?? now(),
                'changefreq' => 'monthly',
                'priority' => '0.5',
            ])
        );

        $urls = $urls->concat(
            Article::query()
                ->where('status', Article::STATUS_PUBLISHED)
                ->get(['slug', 'updated_at', 'published_at'])
                ->map(fn (Article $article) => [
                    'loc' => route('articles.show', $article->slug),
                    'lastmod' => $article->updated_at ?? $article->published_at ?? now(),
                    'changefreq' => 'weekly',
                    'priority' => '0.9',
                ])
        );

        $xml = view('public.sitemap', ['urls' => $urls])->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    public function robots(): Response
    {
        $content = "User-agent: *\nDisallow:\n\nSitemap: " . route('sitemap') . "\n";

        return response($content, 200)->header('Content-Type', 'text/plain');
    }
}

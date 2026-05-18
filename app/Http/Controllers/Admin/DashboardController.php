<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Media;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $counts = Article::query()
            ->selectRaw("sum(status = ?) as draft", [Article::STATUS_DRAFT])
            ->selectRaw("sum(status = ?) as pending_review", [Article::STATUS_PENDING_REVIEW])
            ->selectRaw("sum(status = ?) as approved", [Article::STATUS_APPROVED])
            ->selectRaw("sum(status = ?) as scheduled", [Article::STATUS_SCHEDULED])
            ->selectRaw("sum(status = ?) as published", [Article::STATUS_PUBLISHED])
            ->selectRaw('coalesce(sum(view_count), 0) as total_views')
            ->first();

        $metrics = [
            'published' => (int) $counts->published,
            'draft' => (int) $counts->draft,
            'pending_review' => (int) $counts->pending_review,
            'scheduled' => (int) $counts->scheduled,
            'total_views' => (int) $counts->total_views,
            'media' => Media::query()->count(),
        ];

        $workflow = [
            'draft' => (int) $counts->draft,
            'pending_review' => (int) $counts->pending_review,
            'approved' => (int) $counts->approved,
            'scheduled' => (int) $counts->scheduled,
        ];

        $topViewed = Article::query()
            ->with(['category', 'author'])
            ->where('status', Article::STATUS_PUBLISHED)
            ->orderByDesc('view_count')
            ->latest('published_at')
            ->limit(5)
            ->get();

        $latestPublished = Article::query()
            ->with(['category', 'author'])
            ->where('status', Article::STATUS_PUBLISHED)
            ->latest('published_at')
            ->limit(5)
            ->get();

        return view('admin.dashboard.index', compact('metrics', 'workflow', 'topViewed', 'latestPublished'));
    }
}

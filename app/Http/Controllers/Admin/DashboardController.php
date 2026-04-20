<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $counts = [
            'draft' => Article::where('status', Article::STATUS_DRAFT)->count(),
            'pending_review' => Article::where('status', Article::STATUS_PENDING_REVIEW)->count(),
            'approved' => Article::where('status', Article::STATUS_APPROVED)->count(),
            'scheduled' => Article::where('status', Article::STATUS_SCHEDULED)->count(),
            'published' => Article::where('status', Article::STATUS_PUBLISHED)->count(),
        ];

        $latest = Article::query()->with('author')->latest()->limit(10)->get();

        return view('admin.dashboard.index', compact('counts', 'latest'));
    }
}

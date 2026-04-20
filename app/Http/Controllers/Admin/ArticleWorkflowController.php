<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ScheduleArticleRequest;
use App\Models\Article;
use App\Models\ArticleWorkflowLog;
use App\Models\AuditLog;
use Illuminate\Http\RedirectResponse;

class ArticleWorkflowController extends Controller
{
    public function submitReview(Article $article): RedirectResponse
    {
        if (! auth()->user()->can('articles.submit-review')) {
            abort(403);
        }

        if ($article->author_id !== auth()->id() && ! auth()->user()->hasAnyRole(['Editor', 'Super Admin'])) {
            abort(403);
        }

        $this->transition($article, [Article::STATUS_DRAFT], Article::STATUS_PENDING_REVIEW, 'Submitted for review');

        return back()->with('success', 'Article submitted for review.');
    }

    public function approve(Article $article): RedirectResponse
    {
        if (! auth()->user()->can('articles.approve')) {
            abort(403);
        }

        $this->transition($article, [Article::STATUS_PENDING_REVIEW], Article::STATUS_APPROVED, 'Approved by editor', true);

        return back()->with('success', 'Article approved.');
    }

    public function schedule(ScheduleArticleRequest $request, Article $article): RedirectResponse
    {
        if (! auth()->user()->can('articles.publish')) {
            abort(403);
        }

        $from = $article->status;
        if (! in_array($from, [Article::STATUS_APPROVED], true)) {
            return back()->withErrors(['status' => 'Only approved articles can be scheduled.']);
        }

        $article->update([
            'status' => Article::STATUS_SCHEDULED,
            'publish_at' => $request->date('publish_at'),
            'editor_id' => auth()->id(),
        ]);

        $this->logWorkflow($article, $from, Article::STATUS_SCHEDULED, $request->input('note', 'Scheduled for publish'));

        return back()->with('success', 'Article scheduled.');
    }

    public function publish(Article $article): RedirectResponse
    {
        if (! auth()->user()->can('articles.publish')) {
            abort(403);
        }

        $this->transition(
            $article,
            [Article::STATUS_APPROVED, Article::STATUS_SCHEDULED],
            Article::STATUS_PUBLISHED,
            'Published manually',
            true,
            true
        );

        return back()->with('success', 'Article published.');
    }

    private function transition(
        Article $article,
        array $allowedFrom,
        string $to,
        string $note,
        bool $setEditor = false,
        bool $setPublishedAt = false
    ): void {
        $from = $article->status;

        if (! in_array($from, $allowedFrom, true)) {
            abort(422, 'Invalid workflow transition.');
        }

        $payload = ['status' => $to];
        if ($setEditor) {
            $payload['editor_id'] = auth()->id();
        }
        if ($setPublishedAt) {
            $payload['published_at'] = now();
        }

        $article->update($payload);
        $this->logWorkflow($article, $from, $to, $note);
    }

    private function logWorkflow(Article $article, ?string $from, string $to, ?string $note = null): void
    {
        ArticleWorkflowLog::create([
            'article_id' => $article->id,
            'from_status' => $from,
            'to_status' => $to,
            'acted_by' => auth()->id(),
            'note' => $note,
            'created_at' => now(),
        ]);

        AuditLog::create([
            'user_id' => auth()->id(),
            'event' => 'article.workflow.'.$to,
            'subject_type' => Article::class,
            'subject_id' => $article->id,
            'properties' => ['from' => $from, 'to' => $to],
            'created_at' => now(),
        ]);
    }
}

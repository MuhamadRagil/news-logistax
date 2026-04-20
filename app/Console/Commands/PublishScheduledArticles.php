<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\ArticleWorkflowLog;
use App\Models\AuditLog;
use Illuminate\Console\Command;

class PublishScheduledArticles extends Command
{
    protected $signature = 'articles:publish-scheduled';

    protected $description = 'Publish scheduled articles when publish_at is due';

    public function handle(): int
    {
        $dueArticles = Article::query()
            ->where('status', Article::STATUS_SCHEDULED)
            ->whereNotNull('publish_at')
            ->where('publish_at', '<=', now())
            ->get();

        foreach ($dueArticles as $article) {
            $from = $article->status;
            $article->update([
                'status' => Article::STATUS_PUBLISHED,
                'published_at' => now(),
            ]);

            ArticleWorkflowLog::create([
                'article_id' => $article->id,
                'from_status' => $from,
                'to_status' => Article::STATUS_PUBLISHED,
                'acted_by' => $article->editor_id ?? $article->author_id,
                'note' => 'Auto-published by scheduler',
                'created_at' => now(),
            ]);

            AuditLog::create([
                'user_id' => $article->editor_id ?? $article->author_id,
                'event' => 'article.workflow.published.scheduler',
                'subject_type' => Article::class,
                'subject_id' => $article->id,
                'properties' => ['from' => $from, 'to' => Article::STATUS_PUBLISHED],
                'created_at' => now(),
            ]);

            $this->info("Published: {$article->title}");
        }

        $this->info('Scheduler cycle complete.');

        return self::SUCCESS;
    }
}

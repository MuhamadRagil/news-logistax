<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const STATUS_DRAFT = 'draft';
    public const STATUS_PENDING_REVIEW = 'pending_review';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_SCHEDULED = 'scheduled';
    public const STATUS_PUBLISHED = 'published';

    public const CONTENT_TYPES = ['news', 'announcement', 'opinion', 'press_release'];

    protected $fillable = [
        'uuid',
        'title',
        'slug',
        'subtitle',
        'excerpt',
        'body',
        'status',
        'content_type',
        'category_id',
        'author_id',
        'editor_id',
        'featured_image_id',
        'publish_at',
        'published_at',
        'is_featured',
        'is_indexable',
        'meta_title',
        'meta_description',
        'og_title',
        'og_description',
        'canonical_url',
        'review_notes',
    ];

    protected $casts = [
        'publish_at' => 'datetime',
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'is_indexable' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (Article $article) {
            if (empty($article->uuid)) {
                $article->uuid = (string) Str::uuid();
            }

            if (empty($article->slug) && ! empty($article->title)) {
                $article->slug = static::generateUniqueSlug($article->title);
            }
        });

        static::updating(function (Article $article) {
            if ($article->isDirty('title') && ! $article->isDirty('slug') && ! empty($article->title)) {
                $article->slug = static::generateUniqueSlug($article->title, $article->id);
            }
        });
    }

    public static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 1;

        while (static::query()
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $base.'-'.$i;
            $i++;
        }

        return $slug;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'editor_id');
    }

    public function featuredImage(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'featured_image_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function workflowLogs(): HasMany
    {
        return $this->hasMany(ArticleWorkflowLog::class);
    }
}

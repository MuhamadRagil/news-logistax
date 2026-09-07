<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
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
        'author_name',
        'editor_id',
        'featured_image_id',
        'publish_at',
        'published_at',
        'view_count',
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
        'view_count' => 'integer',
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


    public function getDisplayAuthorNameAttribute(): string
    {
        $manualName = trim((string) $this->author_name);

        if ($manualName !== '') {
            return $manualName;
        }

        return $this->author?->name ?: 'Redaksi Logistax';
    }

    public function getReadTimeMinutesAttribute(): int
    {
        $wordCount = str_word_count(strip_tags($this->body ?? ''));

        return max(1, (int) ceil($wordCount / 200));
    }

    public function getContentTypeLabelAttribute(): string
    {
        return match ($this->content_type) {
            'announcement' => 'Pengumuman',
            'opinion' => 'Opini',
            'press_release' => 'Press Release',
            default => 'Berita',
        };
    }

    public function getContentTypeBadgeClassAttribute(): string
    {
        return match ($this->content_type) {
            'announcement' => 'bg-[#FEF3E2] text-[#D97706]',
            'opinion' => 'bg-[#F1F5F9] text-[#64748B]',
            'press_release' => 'bg-[#F1EAFE] text-[#7C3AED]',
            default => 'bg-[#E8F5FB] text-[#0F4C6C]',
        };
    }

    public static function popular(int $limit = 5, int $days = 7)
    {
        // Cache only the plain ID list (never Eloquent objects: this app's cache
        // config sets `serializable_classes => false` to block object unserialization
        // from cache, a hardening against gadget-chain attacks if APP_KEY leaks).
        // Re-querying by ID also keeps view_count/etc. fresh instead of stale for
        // the cache's lifetime.
        $ids = Cache::remember("articles.popular.ids.{$limit}.{$days}", 300, function () use ($limit, $days) {
            $ids = static::query()
                ->where('status', self::STATUS_PUBLISHED)
                ->where('published_at', '>=', now()->subDays($days))
                ->orderByDesc('view_count')
                ->limit($limit)
                ->pluck('id');

            if ($ids->count() < $limit) {
                $ids = static::query()
                    ->where('status', self::STATUS_PUBLISHED)
                    ->orderByDesc('view_count')
                    ->limit($limit)
                    ->pluck('id');
            }

            return $ids->all();
        });

        if (empty($ids)) {
            return new Collection();
        }

        $articles = static::query()
            ->with(['category', 'featuredImage'])
            ->whereIn('id', $ids)
            ->get()
            ->keyBy('id');

        return collect($ids)
            ->map(fn ($id) => $articles->get($id))
            ->filter()
            ->values();
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

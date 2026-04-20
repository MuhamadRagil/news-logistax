<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('subtitle')->nullable();
            $table->text('excerpt');
            $table->longText('body');
            $table->enum('status', ['draft', 'pending_review', 'approved', 'scheduled', 'published'])->default('draft')->index();
            $table->enum('content_type', ['news', 'announcement', 'opinion', 'press_release'])->default('news')->index();
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('author_id')->constrained('users');
            $table->foreignId('editor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('featured_image_id')->nullable()->constrained('media')->nullOnDelete();
            $table->timestamp('publish_at')->nullable()->index();
            $table->timestamp('published_at')->nullable()->index();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_indexable')->default(true);
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 320)->nullable();
            $table->string('og_title')->nullable();
            $table->string('og_description')->nullable();
            $table->string('canonical_url')->nullable();
            $table->text('review_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'publish_at']);
            $table->index(['category_id', 'published_at']);
            $table->index(['content_type', 'published_at']);
        });

        if (DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE articles ADD FULLTEXT fulltext_articles_search (title, excerpt, body)');
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};

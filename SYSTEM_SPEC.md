# Logistax News Portal — V1 Production Specification

Subdomain target: `news.logistax.id`
Framework target: **Laravel 12**
Authorization package: **Spatie Laravel Permission**

---

## 1) V1 Scope (First Production Release)

V1 is focused on launching a **credible, institutional publication portal** with essential editorial governance and core publishing capabilities.

## 1.1 Content Domains (V1)
- Pajak (Tax)
- Akuntansi (Accounting)
- Hukum (Law)
- Pengumuman (Announcements)
- Opini/Editorial
- Press Release

## 1.2 Public Features (V1)
Required for launch:
- Homepage
- Article detail page
- General article listing page
- Category pages
- Search
- Static pages:
  - About
  - Contact
  - Editorial Policy
  - Privacy Policy

### Homepage (V1)
- Hero section (featured/latest primary story)
- Latest articles list
- Category section blocks
- Announcement/opinion/press release highlights
- Footer with institutional links and static page links

### Listing & Discovery (V1)
- `/artikel` listing with pagination
- `/kategori/{slug}` listing with pagination
- `/pencarian?q=` keyword search against title + excerpt + body
- Basic sort: newest first

### Article Detail (V1)
- Headline, subtitle (optional), excerpt
- Featured image + caption/credit (optional)
- Body content
- Metadata: author, publish date, category, tags
- Basic related content block (same category, latest)

## 1.3 Admin/CMS Features (V1)
Required for launch:
- Admin panel
- Article CRUD
- Category CRUD
- Tag management
- Featured image upload (lightweight)
- Static page management (About, Contact, Editorial Policy, Privacy Policy)
- Basic site settings (site name, logo, footer text)

### Editorial Workflow (V1)
Statuses:
- `draft`
- `pending_review`
- `approved`
- `scheduled`
- `published`

Supported transitions:
- Draft → Pending Review
- Pending Review → Draft (revision request)
- Pending Review → Approved
- Approved → Scheduled
- Approved → Published
- Scheduled → Published (scheduler)

### Roles (V1)
- **Super Admin**
- **Editor**
- **Author**

Using **Spatie Laravel Permission**:
- `roles`, `permissions`, `model_has_roles`, `model_has_permissions`, `role_has_permissions`
- No custom RBAC table design unless additional business need emerges

### Basic SEO (V1)
Per article/page:
- slug
- meta_title
- meta_description
- og_title (optional)
- og_description (optional)
- og_image (optional, via featured image/media)
- canonical_url (optional)
- indexable flag (`is_indexable`)

### Content Type Values (V1)
`content_type` must be exactly:
- `news`
- `announcement`
- `opinion`
- `press_release`

---

## 2) Deferred V2 Scope (Out of V1)

The following are intentionally deferred to avoid overengineering at launch:

- Advanced media management (folders, usage tracking, transformations pipeline)
- Advanced audit/compliance logs
- Full revision diff/version comparison UI
- Redirect manager
- Advanced analytics dashboard (most read trends, cohort analysis)
- Multilingual content
- Advanced editorial workflow boards/calendar assignments
- Enterprise-level monitoring/observability suite
- Personalization/recommendation engine
- Newsletter automation and outbound campaign tooling

---

## 3) Final Recommended Database Schema for V1

> Includes only launch-critical tables. Uses Spatie permission package for RBAC.

## 3.1 users
- `id` bigint PK
- `name` varchar
- `email` varchar unique
- `password` varchar
- `is_active` boolean default true
- `last_login_at` timestamp nullable
- `remember_token` varchar nullable
- `created_at`, `updated_at`

## 3.2 Spatie Permission Tables (standard)
- `roles`
- `permissions`
- `model_has_roles`
- `model_has_permissions`
- `role_has_permissions`

## 3.3 categories
- `id` bigint PK
- `name` varchar
- `slug` varchar unique
- `description` text nullable
- `is_active` boolean default true
- `sort_order` integer default 0
- `created_at`, `updated_at`

## 3.4 tags
- `id` bigint PK
- `name` varchar
- `slug` varchar unique
- `created_at`, `updated_at`

## 3.5 media (lightweight)
- `id` bigint PK
- `disk` varchar default `public`
- `path` varchar
- `filename` varchar
- `mime_type` varchar
- `size_bytes` bigint unsigned
- `alt_text` varchar nullable
- `caption` text nullable
- `credit` varchar nullable
- `uploaded_by` bigint FK → users.id nullable
- `created_at`, `updated_at`

## 3.6 articles
- `id` bigint PK
- `uuid` uuid unique
- `title` varchar
- `slug` varchar unique
- `subtitle` varchar nullable
- `excerpt` text
- `body` longtext
- `status` enum(`draft`,`pending_review`,`approved`,`scheduled`,`published`) index
- `content_type` enum(`news`,`announcement`,`opinion`,`press_release`) index
- `category_id` bigint FK → categories.id index
- `author_id` bigint FK → users.id index
- `editor_id` bigint FK → users.id nullable
- `featured_image_id` bigint FK → media.id nullable
- `publish_at` timestamp nullable index
- `published_at` timestamp nullable index
- `is_featured` boolean default false
- `is_indexable` boolean default true

SEO fields:
- `meta_title` varchar nullable
- `meta_description` varchar(320) nullable
- `og_title` varchar nullable
- `og_description` varchar nullable
- `canonical_url` varchar nullable

Operational fields:
- `review_notes` text nullable
- `created_at`, `updated_at`
- `deleted_at` soft delete

Recommended indexes:
- (`status`, `publish_at`)
- (`category_id`, `published_at`)
- (`content_type`, `published_at`)
- fulltext (`title`, `excerpt`, `body`) if DB engine supports

## 3.7 article_tag (pivot)
- `article_id` bigint FK → articles.id
- `tag_id` bigint FK → tags.id
- composite unique (`article_id`, `tag_id`)

## 3.8 pages (static pages)
- `id` bigint PK
- `title` varchar
- `slug` varchar unique
- `body` longtext
- `status` enum(`draft`,`published`) default `draft`
- `published_at` timestamp nullable
- `meta_title` varchar nullable
- `meta_description` varchar(320) nullable
- `created_at`, `updated_at`

## 3.9 article_workflow_logs (basic)
- `id` bigint PK
- `article_id` bigint FK → articles.id
- `from_status` varchar nullable
- `to_status` varchar
- `acted_by` bigint FK → users.id
- `note` text nullable
- `created_at`

## 3.10 audit_logs (basic)
- `id` bigint PK
- `user_id` bigint FK → users.id nullable
- `event` varchar
- `subject_type` varchar nullable
- `subject_id` bigint nullable
- `properties` json nullable
- `created_at`

---

## 4) Final Recommended Route Structure for V1

## 4.1 Public Routes
```php
Route::get('/', HomeController::class)->name('home');

Route::get('/artikel', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/kategori/{slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/pencarian', [SearchController::class, 'index'])->name('search.index');

Route::view('/tentang', 'pages.about')->name('pages.about');
Route::view('/kontak', 'pages.contact')->name('pages.contact');
Route::view('/kebijakan-editorial', 'pages.editorial-policy')->name('pages.editorial-policy');
Route::view('/kebijakan-privasi', 'pages.privacy')->name('pages.privacy');
```

## 4.2 Admin Routes
```php
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('articles', AdminArticleController::class);
        Route::post('articles/{article}/submit-review', [AdminArticleWorkflowController::class, 'submitReview'])
            ->name('articles.submit-review');
        Route::post('articles/{article}/approve', [AdminArticleWorkflowController::class, 'approve'])
            ->name('articles.approve');
        Route::post('articles/{article}/schedule', [AdminArticleWorkflowController::class, 'schedule'])
            ->name('articles.schedule');
        Route::post('articles/{article}/publish', [AdminArticleWorkflowController::class, 'publish'])
            ->name('articles.publish');

        Route::resource('categories', AdminCategoryController::class)->except(['show']);
        Route::resource('tags', AdminTagController::class)->except(['show']);

        Route::resource('media', AdminMediaController::class)->only(['index', 'store', 'destroy']);

        Route::resource('pages', AdminPageController::class)
            ->only(['index', 'edit', 'update']);

        Route::get('/settings/general', [AdminSettingController::class, 'edit'])->name('settings.general.edit');
        Route::put('/settings/general', [AdminSettingController::class, 'update'])->name('settings.general.update');
    });
```

## 4.3 Scheduler (V1)
- Laravel scheduler job runs every minute.
- Publishes articles where:
  - `status = scheduled`
  - `publish_at <= now()`
- Updates status to `published` and sets `published_at`.

---

## 5) Final Recommended Admin Modules for V1

## 5.1 Dashboard
- Count cards: Draft, Pending Review, Approved, Scheduled, Published
- Latest content activity list

## 5.2 Articles
- List with filters: status, category, content type, author
- Create/Edit/Delete article
- Workflow action buttons (submit, approve, schedule, publish)
- Basic SEO tab

## 5.3 Categories
- Category list
- Create/Edit/Delete
- Slug + active toggle

## 5.4 Tags
- Tag list
- Create/Edit/Delete
- Assignable in article form

## 5.5 Media (Lightweight)
- Upload image
- Reuse existing image
- Edit alt text/caption/credit
- Delete unused media

## 5.6 Static Pages
- Managed pages:
  - About
  - Contact
  - Editorial Policy
  - Privacy Policy
- Draft/Published status

## 5.7 Users & Roles
- User list (basic)
- Assign roles using Spatie permission roles:
  - Super Admin
  - Editor
  - Author

## 5.8 Basic Settings
- Site name
- Site logo
- Footer organization text

## 5.9 Basic Logs
- Workflow logs per article
- Minimal audit log list for critical admin actions

---

## 6) Notes for Implementation Discipline

To keep V1 lean and production-ready:
- Prioritize editorial stability and clean UX over feature breadth.
- Use package defaults (Spatie) where possible.
- Avoid custom abstractions unless needed by current requirements.
- Mark all non-launch features explicitly as V2 backlog items.

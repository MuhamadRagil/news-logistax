<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleStoreRequest;
use App\Http\Requests\Admin\ArticleUpdateRequest;
use App\Models\Article;
use App\Models\AuditLog;
use App\Models\Category;
use App\Models\Media;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:articles.view')->only(['index', 'show']);
        $this->middleware('permission:articles.create')->only(['create', 'store']);
        $this->middleware('permission:articles.edit')->only(['edit', 'update']);
        $this->middleware('permission:articles.delete')->only(['destroy']);
    }

    public function index(Request $request): View
    {
        $query = Article::query()->with(['category', 'author']);

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->integer('category_id'));
        }
        if ($request->filled('content_type')) {
            $query->where('content_type', $request->string('content_type'));
        }

        if (! auth()->user()->hasAnyRole(['Super Admin', 'Editor'])) {
            $query->where('author_id', auth()->id());
        }

        $articles = $query->latest()->paginate(20)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('admin.articles.index', compact('articles', 'categories'));
    }

    public function create(): View
    {
        $article = new Article(['status' => Article::STATUS_DRAFT, 'content_type' => 'news', 'is_indexable' => true]);

        return view('admin.articles.form', [
            'article' => $article,
            'categories' => Category::where('is_active', true)->orderBy('name')->get(),
            'tags' => Tag::orderBy('name')->get(),
            'media' => Media::latest()->limit(50)->get(),
            'selectedTags' => [],
        ]);
    }

    public function store(ArticleStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['author_id'] = auth()->id();
        $data['slug'] = $data['slug'] ?? Article::generateUniqueSlug($data['title']);
        $data['uuid'] = (string) Str::uuid();
        $data['status'] = Article::STATUS_DRAFT;

        $article = Article::create($data);
        $article->tags()->sync($data['tags'] ?? []);

        AuditLog::create([
            'user_id' => auth()->id(),
            'event' => 'article.created',
            'subject_type' => Article::class,
            'subject_id' => $article->id,
            'properties' => ['status' => $article->status],
        ]);

        return redirect()->route('admin.articles.edit', $article)->with('success', 'Article created.');
    }

    public function edit(Article $article): View
    {
        if (auth()->user()->hasRole('Author') && $article->author_id !== auth()->id()) {
            abort(403);
        }

        return view('admin.articles.form', [
            'article' => $article,
            'categories' => Category::where('is_active', true)->orderBy('name')->get(),
            'tags' => Tag::orderBy('name')->get(),
            'media' => Media::latest()->limit(50)->get(),
            'selectedTags' => $article->tags()->pluck('tags.id')->toArray(),
        ]);
    }

    public function update(ArticleUpdateRequest $request, Article $article): RedirectResponse
    {
        if (auth()->user()->hasRole('Author') && ($article->author_id !== auth()->id() || $article->status !== Article::STATUS_DRAFT)) {
            abort(403);
        }

        $data = $request->validated();
        if (empty($data['slug'])) {
            $data['slug'] = Article::generateUniqueSlug($data['title'], $article->id);
        }

        $article->update($data);
        $article->tags()->sync($data['tags'] ?? []);

        AuditLog::create([
            'user_id' => auth()->id(),
            'event' => 'article.updated',
            'subject_type' => Article::class,
            'subject_id' => $article->id,
        ]);

        return back()->with('success', 'Article updated.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        if (auth()->user()->hasRole('Author') && $article->author_id !== auth()->id()) {
            abort(403);
        }

        $article->delete();

        AuditLog::create([
            'user_id' => auth()->id(),
            'event' => 'article.deleted',
            'subject_type' => Article::class,
            'subject_id' => $article->id,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Article deleted.');
    }
}

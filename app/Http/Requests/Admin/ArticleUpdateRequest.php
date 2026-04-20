<?php

namespace App\Http\Requests\Admin;

use App\Models\Article;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('articles.edit') ?? false;
    }

    public function rules(): array
    {
        $articleId = (int) $this->route('article')->id;

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('articles', 'slug')->ignore($articleId)],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['required', 'string'],
            'body' => ['required', 'string'],
            'content_type' => ['required', Rule::in(Article::CONTENT_TYPES)],
            'category_id' => ['required', 'exists:categories,id'],
            'featured_image_id' => ['nullable', 'exists:media,id'],
            'publish_at' => ['nullable', 'date'],
            'is_featured' => ['nullable', 'boolean'],
            'is_indexable' => ['nullable', 'boolean'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:320'],
            'og_title' => ['nullable', 'string', 'max:255'],
            'og_description' => ['nullable', 'string', 'max:255'],
            'canonical_url' => ['nullable', 'url', 'max:255'],
            'review_notes' => ['nullable', 'string'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['exists:tags,id'],
        ];
    }
}

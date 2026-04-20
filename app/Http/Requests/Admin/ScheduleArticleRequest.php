<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('articles.publish') ?? false;
    }

    public function rules(): array
    {
        return [
            'publish_at' => ['required', 'date', 'after:now'],
            'note' => ['nullable', 'string'],
        ];
    }
}

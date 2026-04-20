<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRoleUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('users.manage') ?? false;
    }

    public function rules(): array
    {
        return [
            'role' => ['required', 'in:Super Admin,Editor,Author'],
        ];
    }
}

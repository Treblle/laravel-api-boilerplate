<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\v1_0;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class PostStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'   => ['required', 'string', Rule::unique('posts'), 'max:255'],
            'content' => ['required', 'string'],
        ];
    }
}

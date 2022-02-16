<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\v1_0;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @mixin Post
 */
final class PostUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'   => ['required', 'string', Rule::unique('posts')->ignore($this->id), 'max:255'],
            'content' => ['required', 'string'],
        ];
    }
}

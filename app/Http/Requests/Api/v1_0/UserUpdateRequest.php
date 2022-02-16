<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\v1_0;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @mixin User
 */
final class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', Rule::unique('users')->ignore($this->id), 'email', 'max:255'],
        ];
    }
}

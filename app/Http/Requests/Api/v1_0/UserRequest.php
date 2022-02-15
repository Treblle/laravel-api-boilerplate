<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\v1_0;

use Illuminate\Foundation\Http\FormRequest;

final class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ];
    }
}

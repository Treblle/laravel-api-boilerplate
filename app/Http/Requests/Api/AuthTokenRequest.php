<?php

declare(strict_types=1);

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

final class AuthTokenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'      => ['required', 'email', 'exists:users'],
            'password'   => ['required'],
            'token_name' => ['required', 'alpha_num', 'max:50'],
        ];
    }
}

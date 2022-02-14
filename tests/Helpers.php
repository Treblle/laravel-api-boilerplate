<?php

declare(strict_types=1);

use App\Enums\Version;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Sanctum\Sanctum;

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function actingAs(Authenticatable|null $user = null, array $abilities = ['*'])
{
    if ($user === null) {
        $user = User::factory()->create();
    }

    Sanctum::actingAs($user, $abilities);

    return test();
}

function logout(): void
{
    auth()->logout();
}

function routeVersioned(string $name, array $attributes = [], Version|string $version = 'v1.0'): string
{
    if (is_a($version, Version::class)) {
        $version = $version->value;
    }

    return url('api', [
        'version' => $version,
        'name'    => $name,
    ] + $attributes);
}

<?php

declare(strict_types=1);

use App\Enums\Version;
use App\Models\User;

it('returns a not found error if it tries to call an invalid version', function () {
    $endpoint = routeVersioned('users', ['user' => 1], 'v0.1');

    actingAs()
        ->getJson($endpoint)
        ->assertNotFound();
});

it('shows the given user', function (): void {
    $user = User::factory()->create();
    $endpoint = routeVersioned('users', ['user' => $user], Version::v1_0);

    actingAs()
        ->getJson($endpoint)
        ->assertSuccessful();
});

<?php

declare(strict_types=1);

use App\Enums\Version;
use App\Models\User;

it('returns a not found error if it tries to call an invalid version', function () {
    $endpoint = routeVersioned('users', [], 'v0.1');

    actingAs()
        ->getJson($endpoint)
        ->assertNotFound();
});

it('gets a collection of users', function (): void {
    User::factory(3)->create();
    $endpoint = routeVersioned('users', [], Version::v1_0);

    actingAs()
        ->getJson($endpoint)
        ->assertSuccessful()
        ->assertJsonStructure([
            'data',
            'links',
            'meta',
        ]);
});

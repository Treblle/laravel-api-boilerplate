<?php

declare(strict_types=1);

use App\Enums\Version;
use App\Models\Post;
use Symfony\Component\HttpFoundation\Response;

it('returns a not found error if it tries to call an invalid version', function () {
    $endpoint = routeVersioned('posts', [], 'v0.1');

    actingAs()
        ->getJson($endpoint)
        ->assertStatus(Response::HTTP_NOT_FOUND);
});

it('returns a successful status code', function (): void {
    Post::factory(3)->create();
    $endpoint = routeVersioned('posts', [], Version::v1_0);

    actingAs()
        ->getJson($endpoint)
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([
            'data',
            'links',
            'meta',
        ]);
});

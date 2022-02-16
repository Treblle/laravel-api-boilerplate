<?php

declare(strict_types=1);

use App\Enums\Version;
use App\Models\Post;
use Symfony\Component\HttpFoundation\Response;

it('returns a not found error if it tries to call an invalid version', function () {
    $endpoint = routeVersioned('posts', ['post' => 1], 'v0.1');

    actingAs()
        ->deleteJson($endpoint)
        ->assertStatus(Response::HTTP_NOT_FOUND);
});

it('returns a successful status code', function (): void {
    $post = Post::factory()->create();
    $endpoint = routeVersioned('posts', ['post' => $post], Version::v1_0);

    actingAs()
        ->deleteJson($endpoint)
        ->assertStatus(Response::HTTP_NO_CONTENT);
});

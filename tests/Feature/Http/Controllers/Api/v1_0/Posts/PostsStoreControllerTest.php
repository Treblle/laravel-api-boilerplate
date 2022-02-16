<?php

declare(strict_types=1);

use App\Enums\Version;
use App\Models\Post;
use Symfony\Component\HttpFoundation\Response;

it('returns a not found error if it tries to call an invalid version', function () {
    $endpoint = routeVersioned('posts', [], 'v0.1');

    actingAs()
        ->postJson($endpoint)
        ->assertStatus(Response::HTTP_NOT_FOUND);
});

it('raises an error if title is not provided', function (): void {
    $endpoint = routeVersioned('posts', [], Version::v1_0);

    actingAs()
        ->postJson($endpoint, [
            'content' => 'the post content',
        ])
        ->assertJsonValidationErrorFor('title')
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

it('raises an error if content is not provided', function (): void {
    $endpoint = routeVersioned('posts', [], Version::v1_0);

    actingAs()
        ->postJson($endpoint, [
            'title' => 'the post title',
        ])
        ->assertJsonValidationErrorFor('content')
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

it('creates a new post', function (): void {
    $endpoint = routeVersioned('posts', [], Version::v1_0);

    actingAs()
        ->postJson($endpoint, [
            'title'   => 'The post title',
            'content' => 'The post content',
        ])
        ->assertSuccessful();

    $this->assertDatabaseHas(Post::class, [
        'title'   => 'The post title',
        'content' => 'The post content',
    ]);
});

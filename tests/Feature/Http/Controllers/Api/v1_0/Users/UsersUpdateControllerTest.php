<?php

declare(strict_types=1);

use App\Enums\Version;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

it('returns a not found error if it tries to call an invalid version', function () {
    $endpoint = routeVersioned('users', ['user' => 1], 'v0.1');

    actingAs()
        ->putJson($endpoint)
        ->assertNotFound();
});

it('raises an error if name is not provided', function (): void {
    $user = User::factory()->create();
    $endpoint = routeVersioned('users', ['user' => $user], Version::v1_0);

    actingAs()
        ->putJson($endpoint, [
            'email' => 'john@api-world.com',
        ])
        ->assertJsonValidationErrorFor('name')
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

it('raises an error if name is too long', function (): void {
    $user = User::factory()->create();
    $endpoint = routeVersioned('users', ['user' => $user], Version::v1_0);

    actingAs()
        ->putJson($endpoint, [
            'name' => Str::random(256),
        ])
        ->assertJsonValidationErrorFor('name')
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

it('raises an error if email has an invalid format', function (): void {
    $user = User::factory()->create();
    $endpoint = routeVersioned('users', ['user' => $user], Version::v1_0);

    actingAs()
        ->putJson($endpoint, [
            'name' => 'John Doe',
        ])
        ->assertJsonValidationErrorFor('email')
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

it('raises an error if email is not in the correct format', function (): void {
    $user = User::factory()->create();
    $endpoint = routeVersioned('users', ['user' => $user], Version::v1_0);

    actingAs()
        ->putJson($endpoint, [
            'email' => 'this is not an email',
        ])
        ->assertJsonValidationErrorFor('email')
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

it('updates the given user', function (): void {
    $user = User::factory()->create();
    $endpoint = routeVersioned('users', ['user' => $user], Version::v1_0);

    actingAs()
        ->putJson($endpoint, [
            'name'  => 'John Doe',
            'email' => 'john@api-world.com',
        ])
        ->assertSuccessful();

    $this->assertDatabaseMissing(User::class, [
        'name'  => $user->name,
        'email' => $user->email,
    ]);

    $this->assertDatabaseHas(User::class, [
        'id'    => $user->id,
        'name'  => 'John Doe',
        'email' => 'john@api-world.com',
    ]);
});

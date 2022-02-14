<?php

declare(strict_types=1);

use App\Enums\Version;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

it('returns a not found error if it tries to call an invalid version', function () {
    $endpoint = routeVersioned('users', ['user' => 1], 'v0.1');

    actingAs()
        ->deleteJson($endpoint)
        ->assertNotFound();
});

it('destroys the given user', function (): void {
    $user = User::factory()->create();
    $endpoint = routeVersioned('users', ['user' => $user->uuid], Version::v1_0);

    actingAs()
        ->deleteJson($endpoint)
        ->assertStatus(Response::HTTP_NO_CONTENT);

    $this->assertDatabaseMissing(User::class, [
        'uuid' => $user->uuid,
    ]);
});

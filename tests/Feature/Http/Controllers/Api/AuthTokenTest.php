<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Str;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\postJson;
use Symfony\Component\HttpFoundation\Response;

it('fails if email is not provided', function (): void {
    $user = User::factory()->create();

    postJson(url('api/auth/token'), [
        'password'   => $user->password,
        'token_name' => 'acme 1',
    ])
        ->assertJsonValidationErrorFor('email')
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

it('fails if email does not exist', function (): void {
    $user = User::factory()->create();

    postJson(url('api/auth/token'), [
        'email'      => 'foo@example.com',
        'password'   => $user->password,
        'token_name' => 'acme 1',
    ])
        ->assertJsonValidationErrorFor('email')
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

it('fails if email is not a valid email address', function (): void {
    $user = User::factory()->create();

    postJson(url('api/auth/token'), [
        'email'      => 'not a valid email address',
        'password'   => $user->password,
        'token_name' => 'acme 1',
    ])
        ->assertJsonValidationErrorFor('email')
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

it('fails if password is not provided', function (): void {
    $user = User::factory()->create();

    postJson(url('api/auth/token'), [
        'email'      => $user->email,
        'token_name' => 'acme 1',
    ])
        ->assertJsonValidationErrorFor('password')
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

it('fails if token name is not provided', function (): void {
    $user = User::factory()->create();

    postJson(url('api/auth/token'), [
        'email'    => $user->email,
        'password' => $user->password,
    ])
        ->assertJsonValidationErrorFor('token_name')
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

it('fails if token name does not contains only alphanumeric characters', function (): void {
    $user = User::factory()->create();

    postJson(url('api/auth/token'), [
        'email'      => $user->email,
        'password'   => $user->password,
        'token_name' => 'acme 1',
    ])
        ->assertJsonValidationErrorFor('token_name')
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

it('fails if token name is too long', function (): void {
    $user = User::factory()->create();

    postJson(url('api/auth/token'), [
        'email'      => $user->email,
        'password'   => $user->password,
        'token_name' => Str::random(51),
    ])
        ->assertJsonValidationErrorFor('token_name')
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

it('creates a new token for the given user', function (): void {
    $user = User::factory()->create();

    assertDatabaseMissing('personal_access_tokens', [
        'name' => 'Acme001',
    ]);

    postJson(url('api/auth/token'), [
        'email'      => $user->email,
        'password'   => 'password',
        'token_name' => 'Acme001',
    ])
        ->assertStatus(Response::HTTP_CREATED)
        ->assertJsonStructure(['token']);

    assertDatabaseHas('personal_access_tokens', [
        'name' => 'Acme001',
    ]);
});

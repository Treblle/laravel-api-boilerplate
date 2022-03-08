<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Str;
use function Pest\Laravel\artisan;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

it('raise an error if name is not present', function (): void {
    artisan('user:create', [
        '--name'     => '',
        '--email'    => 'john.doe@example.com',
        '--password' => 'password',
    ])
        ->expectsOutput(trans('validation.required', ['attribute' => 'name']))
        ->assertExitCode(1);

    assertDatabaseMissing(User::class, [
        'email' => 'john.doe@example.com',
    ]);
});

it('raise an error if name is too long', function (): void {
    artisan('user:create', [
        '--name'     => Str::random(256),
        '--email'    => 'john.doe@example.com',
        '--password' => 'password',
    ])
        ->expectsOutput(trans('validation.max.string', ['attribute' => 'name', 'max' => '255']))
        ->assertExitCode(1);

    assertDatabaseMissing(User::class, [
        'email' => 'john.doe@example.com',
    ]);
});

it('raise an error if email is not present', function (): void {
    artisan('user:create', [
        '--name'     => 'John Doe',
        '--email'    => '',
        '--password' => 'password',
    ])
        ->expectsOutput(trans('validation.required', ['attribute' => 'email']))
        ->assertExitCode(1);

    assertDatabaseMissing(User::class, [
        'name' => 'John Doe',
    ]);
});

it('raise an error if email is not a valid email address', function (): void {
    artisan('user:create', [
        '--name'     => 'John Doe',
        '--email'    => 'not a valid email address',
        '--password' => 'password',
    ])
        ->expectsOutput(trans('validation.email', ['attribute' => 'email']))
        ->assertExitCode(1);

    assertDatabaseMissing(User::class, [
        'name' => 'John Doe',
    ]);
});

it('raise an error if email is too long', function (): void {
    artisan('user:create', [
        '--name'     => 'John Doe',
        '--email'    => Str::random(244).'@example.com',
        '--password' => 'password',
    ])
        ->expectsOutput(trans('validation.max.string', ['attribute' => 'email', 'max' => '255']))
        ->assertExitCode(1);

    assertDatabaseMissing(User::class, [
        'name' => 'John Doe',
    ]);
});

it('raise an error if password is not present', function (): void {
    artisan('user:create', [
        '--name'     => 'John Doe',
        '--email'    => Str::random(245).'@example.com',
        '--password' => '',
    ])
        ->expectsOutput(trans('validation.required', ['attribute' => 'password']))
        ->assertExitCode(1);

    assertDatabaseMissing(User::class, [
        'name' => 'John Doe',
    ]);
});

it('raise an error if password is less than 6 characters', function (): void {
    artisan('user:create', [
        '--name'     => 'John Doe',
        '--email'    => Str::random(245).'@example.com',
        '--password' => 'passw',
    ])
        ->expectsOutput(trans('validation.min.string', ['attribute' => 'password', 'min' => '6']))
        ->assertExitCode(1);

    assertDatabaseMissing(User::class, [
        'name' => 'John Doe',
    ]);
});

it('creates a new user with data passed inline', function (): void {
    artisan('user:create', [
        '--name'     => 'John Doe',
        '--email'    => 'john.doe@example.com',
        '--password' => 'password',
    ])
        ->expectsOutput(trans('artisan.create_user.alerts.confirmation'))
        ->expectsTable(['Name', 'Email', 'Password'], [
            ['John Doe', 'john.doe@example.com', 'password'],
        ])
        ->assertExitCode(0);

    assertDatabaseHas(User::class, [
        'name'  => 'John Doe',
        'email' => 'john.doe@example.com',
    ]);
});

it('creates a new user', function (): void {
    artisan('user:create')
        ->expectsOutput(trans('artisan.create_user.description'))
        ->expectsConfirmation(trans('artisan.create_user.dialogs.confirm_before_executing'), 'yes')
        ->expectsQuestion(trans('artisan.create_user.questions.name'), 'John Doe')
        ->expectsQuestion(trans('artisan.create_user.questions.email'), 'john.doe@example.com')
        ->expectsQuestion(trans('artisan.create_user.questions.password'), 'password')
        ->expectsOutput(trans('artisan.create_user.alerts.confirmation'))
        ->expectsTable(['Name', 'Email', 'Password'], [
            ['John Doe', 'john.doe@example.com', 'password'],
        ])
        ->assertExitCode(0);

    assertDatabaseHas(User::class, [
        'name'  => 'John Doe',
        'email' => 'john.doe@example.com',
    ]);
});

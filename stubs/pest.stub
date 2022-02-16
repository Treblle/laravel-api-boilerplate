<?php

declare(strict_types=1);

use App\Enums\Version;
use Symfony\Component\HttpFoundation\Response;

it('returns a not found error if it tries to call an invalid version', function () {
    $endpoint = routeVersioned('{{ change with the resource name }}', ['{{ change with the param name }}' => 1], 'v0.1');

    actingAs()
        // use the correct verb for your use case. For example `deleteJson($endpoint)`
        ->getJson($endpoint)
        ->assertStatus(Response::HTTP_NOT_FOUND);
});

it('returns a successful status code', function (): void {
    $endpoint = routeVersioned('{{ change with the resource name }}', ['{{ change with the param name }}' => 1], Version::v1_0);

    actingAs()
        // use the correct verb for your use case. For example `deleteJson($endpoint)`
        ->getJson($endpoint)
        ->assertStatus(Response::HTTP_OK);
});

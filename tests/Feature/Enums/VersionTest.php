<?php

declare(strict_types=1);

use App\Enums\Version;

it('checks if the version satisfies the given constraint', function (): void {
    expect(Version::v1_0->satisfies('^1.0'))->toBeTrue();
    expect(Version::v1_1->satisfies('^1.0'))->toBeTrue();
    expect(Version::v1_0->satisfies('^1.1'))->toBeFalse();
    expect(Version::v1_1->satisfies('1.0'))->toBeFalse();
    expect(Version::v1_1->satisfies('^1.1'))->toBeTrue();
    expect(Version::v2_0->satisfies('^1.1'))->toBeFalse();
    expect(Version::v2_0->satisfies('^2.0'))->toBeTrue();
});

it('checks if the version is greater than a given one', function (): void {
    expect(Version::v1_1->greaterThan(Version::v1_0))->toBeTrue();
    expect(Version::v1_0->greaterThan(Version::v1_0))->toBeFalse();
    expect(Version::v1_0->greaterThan(Version::v1_1))->toBeFalse();
});

it('checks if the version is greater than or equals to a given one', function (): void {
    expect(Version::v1_0->greaterThanOrEqualsTo(Version::v1_0))->toBeTrue();
    expect(Version::v1_0->greaterThanOrEqualsTo(Version::v1_1))->toBeFalse();
});

it('checks if the version is less than a given one', function (): void {
    expect(Version::v1_0->lessThan(Version::v1_1))->toBeTrue();
    expect(Version::v1_0->lessThan(Version::v1_0))->toBeFalse();
    expect(Version::v1_1->lessThan(Version::v1_0))->toBeFalse();
});

it('checks if the version is less than or equals to a given one', function (): void {
    expect(Version::v1_0->lessThanOrEqualsTo(Version::v1_0))->toBeTrue();
    expect(Version::v1_1->lessThanOrEqualsTo(Version::v1_0))->toBeFalse();
});

it('checks if the version is equals to a given one', function (): void {
    expect(Version::v1_0->equalsTo(Version::v1_0))->toBeTrue();
    expect(Version::v1_0->equalsTo(Version::v1_1))->toBeFalse();
});

it('checks if the version is not equals to a given one', function (): void {
    expect(Version::v1_0->notEqualsTo(Version::v1_0))->toBeFalse();
    expect(Version::v1_0->notEqualsTo(Version::v1_1))->toBeTrue();
});

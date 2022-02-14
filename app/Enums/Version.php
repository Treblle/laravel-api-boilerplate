<?php

declare(strict_types=1);

namespace App\Enums;

use Composer\Semver\Comparator;
use Composer\Semver\Semver;
use Illuminate\Support\Str;

enum Version: string
{
    case v1_0 = 'v1.0';
    case v1_1 = 'v1.1'; // example
    case v2_0 = 'v2.0'; // example

    public function satisfies(string $constraints): bool
    {
        return Semver::satisfies($this->value, $constraints);
    }

    public function equalsTo(self $version): bool
    {
        return Comparator::equalTo(
            self::normalize($this->value),
            self::normalize($version->value)
        );
    }

    public function notEqualsTo(self $version): bool
    {
        return Comparator::notEqualTo(
            self::normalize($this->value),
            self::normalize($version->value)
        );
    }

    public function greaterThan(self $version): bool
    {
        return Comparator::greaterThan(
            self::normalize($this->value),
            self::normalize($version->value)
        );
    }

    public function greaterThanOrEqualsTo(self $version): bool
    {
        return Comparator::greaterThanOrEqualTo(
            self::normalize($this->value),
            self::normalize($version->value)
        );
    }

    public function lessThan(self $version): bool
    {
        return Comparator::lessThan(
            self::normalize($this->value),
            self::normalize($version->value)
        );
    }

    public function lessThanOrEqualsTo(self $version): bool
    {
        return Comparator::lessThanOrEqualTo(
            self::normalize($this->value),
            self::normalize($version->value)
        );
    }

    private static function normalize(string $input): string
    {
        return (string) Str::of($input)->ltrim('v');
    }
}

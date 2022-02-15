<?php

declare(strict_types=1);

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

trait InteractsWithUuid
{
    public static function bootInteractsWithUuid(): void
    {
        self::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    /**
     * @param Builder<Model> $query
     */
    public function scopeFindByUuid(Builder $query, string $uuid): Model|null
    {
        return $query->where('uuid', $uuid)->first();
    }

    /**
     * @param Builder<Model> $query
     * @throws ModelNotFoundException
     */
    public function scopeFindOrFailByUuid(Builder $query, string $uuid): Model
    {
        return $query->where('uuid', $uuid)->firstOrFail();
    }
}

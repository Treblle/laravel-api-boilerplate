<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Posts;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\Version;
use App\Http\Requests\Api\v1_0\PostStoreRequest;
use App\Http\Resources\v1_0\PostResource;

final class PostsStoreController extends Controller
{
    public function __invoke(PostStoreRequest $request, Version $version): JsonResource
    {
        abort_unless(
            $version->greaterThanOrEqualsTo(Version::v1_0),
            Response::HTTP_NOT_FOUND
        );

        $post = $request->user()->posts()->create($request->validated());

        return PostResource::make($post);
    }
}

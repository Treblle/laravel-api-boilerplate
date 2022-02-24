<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Posts;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\Version;
use App\Http\Requests\Api\v1_0\PostUpdateRequest;
use App\Http\Resources\v1_0\PostResource;
use App\Models\Post;

final class PostsUpdateController extends Controller
{
    public function __invoke(PostUpdateRequest $request, Version $version, Post $post): JsonResource
    {
        abort_unless(
            $version->greaterThanOrEqualsTo(Version::v1_0),
            Response::HTTP_NOT_FOUND
        );

        $post->update($request->validated());

        return PostResource::make($post->refresh());
    }
}

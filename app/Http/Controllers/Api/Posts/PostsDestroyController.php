<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Posts;

use App\Enums\Version;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

final class PostsDestroyController extends Controller
{
    public function __invoke(Request $request, Version $version, Post $post): JsonResponse
    {
        abort_unless(
            $version->greaterThanOrEqualsTo(Version::v1_0),
            Response::HTTP_NOT_FOUND
        );

        $post->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}

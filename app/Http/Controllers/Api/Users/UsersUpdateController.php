<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Users;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\Version;
use App\Http\Requests\Api\v1_0\UserUpdateRequest;
use App\Http\Resources\v1_0\UserResource;
use App\Models\User;

final class UsersUpdateController extends Controller
{
    public function __invoke(UserUpdateRequest $request, Version $version, User $user): JsonResource
    {
        abort_unless(
            $version->greaterThanOrEqualsTo(Version::v1_0),
            Response::HTTP_NOT_FOUND
        );

        $user->update($request->validated());

        return UserResource::make($user->refresh());
    }
}

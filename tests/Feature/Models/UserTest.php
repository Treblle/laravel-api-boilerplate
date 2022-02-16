<?php

declare(strict_types=1);

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

it('has many posts', function () {
    $user = User::factory()->create();
    $ownedPosts = Post::factory(3)->create(['user_id' => $user->id]);
    $otherPosts = Post::factory(3)->create();

    expect($user->posts)->toBeInstanceOf(Collection::class);
    expect($user->posts)->toHaveCount(3);
    expect($user->posts[0]->id)->toBe($ownedPosts[0]->id);
    expect($user->posts[1]->id)->toBe($ownedPosts[1]->id);
    expect($user->posts[2]->id)->toBe($ownedPosts[2]->id);
    expect($user->posts[0]->id)->not()->toBe($otherPosts[0]->id);
    expect($user->posts[1]->id)->not()->toBe($otherPosts[1]->id);
    expect($user->posts[2]->id)->not()->toBe($otherPosts[2]->id);
});

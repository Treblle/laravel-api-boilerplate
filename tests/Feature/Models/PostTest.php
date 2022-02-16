<?php

declare(strict_types=1);

use App\Models\Post;
use App\Models\User;

it('has an author', function () {
    $post = Post::factory()->create();

    expect($post->author)->toBeInstanceOf(User::class);
});

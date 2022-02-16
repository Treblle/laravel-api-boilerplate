<?php

declare(strict_types=1);

namespace App\Http\Resources\v1_0;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Post
 */
final class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid'       => $this->uuid,
            'title'      => $this->title,
            'body'       => $this->content,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'author'     => $this->whenLoaded('author', UserResource::make($this->author)),
        ];
    }
}

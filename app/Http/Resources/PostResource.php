<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     */
    public function toArray($request): array|Arrayable|JsonSerializable
    {
        return [
            'entryId'        => $this->id,
            'title'          => $this->title,
            'body'           => $this->body,
            'headerImageUrl' => $this->header_image?->url,
            'comments'       => CommentResource::collection(Comment::where('entry_id', $this->id)->get()),
            'tags'           => $this->tags,
            'createdAt'      => $this->date,
        ];
    }
}

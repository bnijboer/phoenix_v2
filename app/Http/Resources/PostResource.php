<?php

namespace App\Http\Resources;

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
        $response = [
            'entryId'        => $this->entry_id,
            'title'          => $this->title,
            'body'           => $this->body,
            'headerImageUrl' => $this->header_image?->url,
            'createdAt'      => $this->date,
        ];

        if ($this->comments) {
            $response['comments'] = CommentResource::collection($this->comments);
        }

        if ($this->tags) {
            $response['tags'] = $this->tags;
        }

        return $response;
    }
}

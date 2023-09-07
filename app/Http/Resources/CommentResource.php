<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     */
    public function toArray($request): array|Arrayable|JsonSerializable
    {
        return [
            'id'        => $this->id,
            'entryId'   => $this->entry_id,
            'body'      => $this->body,
            'createdAt' => $this->created_at,
            'user'      => new UserResource($this->user),
        ];
    }
}

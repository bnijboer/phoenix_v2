<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class PostPreviewResource extends JsonResource
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
            'headerImageUrl' => $this->header_image?->url,
            'previewText'    => $this->description_text,
            'createdAt'      => $this->date->locale('nl')->isoFormat('dddd D MMMM YYYY'),
            'updatedAt'      => $this->updated_at->locale('nl')->isoFormat('dddd D MMMM YYYY'),
            'commentCount'   => Comment::where('entry_id', $this->id)->count()
        ];
    }
}

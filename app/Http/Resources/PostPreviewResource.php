<?php

namespace App\Http\Resources;

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
            'updatedAt'      => $this->updated_at,
            'date'           => $this->date,
        ];
    }
}

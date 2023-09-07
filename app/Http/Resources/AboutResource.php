<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class AboutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     */
    public function toArray($request): array|Arrayable|JsonSerializable
    {
        return [
            'title' => $this->title,
            'body'  => $this->body,
            'image' => $this->image->url,
        ];
    }
}

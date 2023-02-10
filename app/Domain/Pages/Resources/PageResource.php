<?php

namespace DDD\Domain\Pages\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

// Resources
use DDD\Domain\Base\Statuses\Resources\StatusResource;
use DDD\Domain\Base\Categories\Resources\CategoryResource;
use DDD\Domain\Base\Users\Resources\UserResource;

class PageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'http_status' => $this->http_status,
            'title' => $this->title,
            'url' => $this->url,
            'wordcount' => $this->wordcount,

            'status' => new StatusResource($this->status),
            'category' => new CategoryResource($this->category),

            // 'status' => new StatusResource($this->whenLoaded('status')),
            // 'category' => new CategoryResource($this->whenLoaded('category')),

            // 'status' => $this->whenLoaded('status', fn() => $this->status->slug),
            // 'category' => $this->whenLoaded('category', fn() => $this->category->slug),

            'children' => PageResource::collection($this->children),
            // 'children' => PageResource::collection($this->whenLoaded('descendants')),

            'created_at' => $this->created_at,
        ];;
    }
}

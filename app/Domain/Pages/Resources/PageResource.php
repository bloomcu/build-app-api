<?php

namespace DDD\Domain\Pages\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use DDD\Domain\Pages\Resources\PageTypeResource;
use DDD\Domain\Pages\Resources\PageJunkStatusResource;
use DDD\Domain\Base\Statuses\Resources\StatusResource;
use DDD\Domain\Base\Categories\Resources\CategoryResource;

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
            'parent_id' => $this->parent_id,
            'http_status' => $this->http_status,
            'title' => $this->title,
            'url' => $this->url,
            'wordcount' => $this->wordcount,
            'category' => new CategoryResource($this->category),
            'status' => new StatusResource($this->status),
            'order' => $this->order,
            // 'children' => PageResource::collection($this->children),
            'children' => PageResource::collection($this->whenLoaded('children')),
            'type' => new PageTypeResource($this->type),
            'junk_status' => new PageJunkStatusResource($this->junkStatus),
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
        ];;
    }
}

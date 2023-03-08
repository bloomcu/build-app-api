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
            'parent_id' => $this->parent_id,
            'http_status' => $this->http_status,
            'title' => $this->title,
            'url' => $this->url,
            'wordcount' => $this->wordcount,
            'category' => new CategoryResource($this->category),
            'status' => new StatusResource($this->status),
            'order' => $this->order,
            'children' => PageResource::collection($this->children),
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
        ];;
    }
}

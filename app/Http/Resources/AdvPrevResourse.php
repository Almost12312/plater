<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdvPrevResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if (count($this->resource->files) > 0)
        {
            return [
                'id' => $this->resource->id,
                'title' => $this->resource->title,
                'content' => $this->resource->content,
                'location' => $this->resource->location,
                'price' => $this->resource->price,
                'status' => $this->resource->status,
                'category' => $this->resource->category_id,
                'tags' => TagResource::make($this->resource)
            ];

        } else {
            return [
                'id' => $this->resource->id,
                'title' => $this->resource->title,
                'content' => $this->resource->content,
                'location' => $this->resource->location,
                'price' => $this->resource->price,
                'status' => $this->resource->status,
                'category' => '',
                'tags' => []
            ];
        }
    }
}

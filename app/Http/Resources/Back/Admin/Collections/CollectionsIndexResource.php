<?php

namespace App\Http\Resources\Back\Admin\Collections;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CollectionsIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'collection_title' => $this->collection_title,
            'slug' => $this->slug,
            'poster' => URL('/storage/collections/posters/' . $this->poster),
            'description_min' => $this->description_min,
            'description' => $this->description,
            'articles' => ArticlesIndexResource::collection($this->articles)->resolve(),
            'meta_title' => $this->meta_title,
            'meta_keywords' => $this->meta_keywords,
            'meta_description' => $this->meta_description,
            'is_published' => $this->is_published,
        ];
    }
}

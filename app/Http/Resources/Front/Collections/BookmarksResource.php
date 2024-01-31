<?php

namespace App\Http\Resources\Front\Collections;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookmarksResource extends JsonResource
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
            'slug' => $this->slug,
            'collection_title' => $this->collection_title,
            'description_min' => $this->description_min,
            'poster' => URL('/storage/collections/posters/' . $this->poster),
        ];
    }
}

<?php

namespace App\Http\Resources\Front\Collections;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class SingleIndexResource extends JsonResource
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
            'date' => Carbon::parse($this->updated_at)->format('d-m-Y H:i'),
            'collection_title' => $this->collection_title,
            'rating' => $this->rating,
            'description_min' => $this->description_min,
            'description' => $this->description,
            'articles' => ArticlesIndexResource::collection($this->articles)->resolve(),
            'comments' => CommentsResource::collection($this->comments()->where('approved', 1)->orderBy('id', 'DESC')->get())->resolve(),
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
        ];
    }
}

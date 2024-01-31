<?php

namespace App\Http\Resources\Back\Admin\Collections;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticlesIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return [
            'article_title' => $this->title,
            'article_description' => $this->description,
            'article_image' => URL('/storage/collections/articles/' . $this->image),
            'article_movie'=> $this->movie_id,
        ];
    }
}

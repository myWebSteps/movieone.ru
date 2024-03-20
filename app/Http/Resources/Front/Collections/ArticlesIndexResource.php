<?php

namespace App\Http\Resources\Front\Collections;

use App\Http\Resources\Front\Collections\MoviesIndexResource;
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
        $movies = new MoviesIndexResource($this->movie);
        $movies = $movies->resolve();

        return [
            'article_id' => $this->id,
            'article_title' => $this->title,
            'description' => $this->description,
            'image' => URL('/storage/Collections/Articles/' . $this->image),
            'movies'=> $movies,
        ];
    }
}

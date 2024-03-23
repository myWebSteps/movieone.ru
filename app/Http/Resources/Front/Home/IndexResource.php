<?php

namespace App\Http\Resources\Front\Home;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'category_id' => $this->id,
            'category' => $this->title,
            'slug' => $this->slug,
            'movies' => MoviesResource::collection($this->movies->sortBy([['id', 'DESC']])->take(5))->resolve(),
           ];

    }
}

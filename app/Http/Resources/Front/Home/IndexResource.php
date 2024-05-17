<?php

namespace App\Http\Resources\Front\Home;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

class IndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $movies = Cache::get("movies")->where('category_id', $this->id)->sortBy([['id', "DESC"]])->take(6);

        return [
            'category_id' => $this->id,
            'category' => $this->title,
            'slug' => $this->slug,
            'movies' => MoviesResource::collection($movies)->resolve(),
           ];

    }
}

<?php

namespace App\Http\Resources\Front\Catalog;

use App\Models\GenreMovie;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GenresResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $moviesCount = GenreMovie::where('genre_id', $this->id)->count();

        return [
                'genresCount' => $moviesCount,
                'genre' => [
                    'id' => $this->id,
                    'category_id' => $this->category_id,
                    'title' => $this->title,
                    'slug' => $this->slug,
                ]
        ];
    }
}

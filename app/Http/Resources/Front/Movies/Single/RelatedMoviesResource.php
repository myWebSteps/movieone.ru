<?php

namespace App\Http\Resources\Front\Movies\Single;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RelatedMoviesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $poster_path = url('/storage/movies'.$this->poster);

        return [
                'id' => $this->id,
                'slug' => $this->slug,
                'nameRu' => $this->nameRu,
                'nameEn' => $this->nameEn,
                'poster' => $poster_path,
                'year' => $this->year,
                'genres' => $this->genres,
           ];

    }
}

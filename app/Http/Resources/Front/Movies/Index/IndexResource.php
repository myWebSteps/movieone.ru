<?php

namespace App\Http\Resources\Front\Movies\Index;

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
        $posterUrl = url('storage/movies' . $this->poster);

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'kinopoisk_id' => $this->kinopoisk_id,
            'nameRu' => $this->nameRu,
            'nameEn' => $this->nameEn,
            'poster' => $posterUrl,
            'genres' => $this->genres,
            'year' => $this->year,
        ];
    }
}

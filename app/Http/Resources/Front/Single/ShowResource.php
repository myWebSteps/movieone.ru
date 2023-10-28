<?php

namespace App\Http\Resources\Front\Single;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $posterUrl = url('storage' . $this->poster);

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'kinopoisk_id' => $this->kinopoisk_id,
            'posterUrl' => $posterUrl,
            'trailer' => $this->trailer,
            'nameRu' => $this->nameRu,
            'nameEn' => $this->nameEn,
            'age_limits' => $this->age_limits,
            'category' => $this->category_id,
            'genres' => $this->genres,
            'type' => $this->type,
            'slogan' => $this->slogan,
            'description' => $this->description,
            'filmLength' => $this->duration,
            'endYear' => $this->year,
            'rate' => $this->rate,
            'countries' => $this->countries,
            'video_allowed' => $this->video_allowed,
        ];
    }
}

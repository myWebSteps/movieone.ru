<?php

namespace App\Http\Resources\Front\Single;

use App\Http\Resources\Back\Admin\Comments\IndexResource;
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
        if($this->backdrop != null) {
            $backdropUrl = url('storage' . $this->backdrop);
        }else{
            $backdropUrl = null;
        }

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'kinopoisk_id' => $this->kinopoisk_id,
            'posterUrl' => $posterUrl,
            'backdropUrl' => $backdropUrl,
            'trailers' => [
                'videos_count' => $this->trailers->count(),
                'videos' => $this->trailers
            ],
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
            'budget' => $this->budget,
            'countries' => $this->countries,
            'video_allowed' => $this->video_allowed,

        ];
    }
}

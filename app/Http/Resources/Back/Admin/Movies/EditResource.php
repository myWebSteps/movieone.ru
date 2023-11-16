<?php

namespace App\Http\Resources\Back\Admin\Movies;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EditResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $posterUrl = url('storage' . $this->poster);
        $backdropUrl = url('storage' . $this->backdrop);

        $genresArr = [];
        foreach ($this->genres->toArray() as $item){
            $genresArr[] = $item['id'];
        };
        $countriesArr = [];
        foreach ($this->countries->toArray() as $item){
            $countriesArr[] = $item['id'];
        };


        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'kinopoisk_id' => $this->kinopoisk_id,
            'nameRu' => $this->nameRu,
            'nameEn' => $this->nameEn,
            'age_limits' => $this->age_limits,
            'poster' => $posterUrl,
            'backdrop' => $backdropUrl,
            'trailers' => $this->trailers,
            'type' => $this->type,
            'category_id' => $this->category_id,
            'genres' => $genresArr,
            'countries' => $countriesArr,
            'year' => $this->year,
            'duration' => $this->duration,
            'rate' => $this->rate,
            'budget' =>$this->budget,
            'slogan' => $this->slogan,
            'description' => $this->description,
            'video_allowed' => $this->video_allowed,
            'title_id' => $this->title,
            'meta_keywords' => $this->meta_keywords,
            'meta_description' => $this->meta_description,
        ];
    }
}

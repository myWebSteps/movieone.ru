<?php

namespace App\Http\Resources\Front\Movies\Single;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaylistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'nameRu' => $this->nameRu,
            'nameEn' => $this->nameEn,
            'year' => $this->year,
            'genres' => $this->genres,
            'posterUrl' => url('/storage/movies'.$this->poster),
        ];
    }
}

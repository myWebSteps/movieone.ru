<?php

namespace App\Http\Resources\Front\Catalog;

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
        $posterUrl = url('storage' . $this->poster);

        return [
            'id' => $this->id,
            'kinopoisk_id' => $this->kinopoisk_id,
            'nameRu' => $this->nameRu,
            'nameEn' => $this->nameEn,
            'posterUrl' => $posterUrl,
            'genres' => $this->genres,
            'year' => $this->year,
        ];
    }
}

<?php

namespace App\Http\Resources\Back\Admin\Movies;

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
            'id' => $this->id,
            'kinopoisk_id' => $this->kinopoisk_id,
            'year' => $this->year,
            'nameRu' => $this->nameRu,
            'nameEn' => $this->nameEn
        ];
    }
}

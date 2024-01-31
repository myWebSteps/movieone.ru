<?php

namespace App\Http\Resources\Back\Admin\Collections;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MoviesIndexResource extends JsonResource
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
            'nameRu' => $this->nameRu,
            'nameEn' => $this->nameEn,
            'year' => $this->year,
        ];
    }
}

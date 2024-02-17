<?php

namespace App\Http\Resources\Front\Collections;

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
            'slug' => $this->slug,
            'plot' => $this->plot,
            'actors_game' => $this->actors_game,
            'atmosphere' => $this->atmosphere,
            'rating' => $this->rate,
        ];
    }
}

<?php

namespace App\Http\Resources\Back\Admin\Comments\Movies;

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
            'comment_id' => $this->id,
            'movie_id' => $this->movie_id,
            'movie_name' => $this->movie->nameRu,
            'name' => $this->name,
            'rating' => $this->rating,
            'description' => $this->description,
            'approved' => $this->approved,
        ];
    }
}

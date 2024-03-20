<?php

namespace App\Http\Resources\Front\Movies\Single;

use App\Http\Resources\Back\Admin\Comments\IndexResource;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'plot' => $this->plot,
            'actors_game' => $this->actors_game,
            'atmosphere' => $this->atmosphere,
            'rating' => $this->rating,
            'description' => $this->description,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}

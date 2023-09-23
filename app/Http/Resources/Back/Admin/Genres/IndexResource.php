<?php

namespace App\Http\Resources\Back\Admin\Genres;

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
           'category_id' => $this->id,
           'category_title' => $this->title,
           'genres' => $this->genres,
        ];
    }
}

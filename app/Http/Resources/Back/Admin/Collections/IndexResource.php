<?php

namespace App\Http\Resources\Back\Admin\Collections;

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
            'collection_title' => $this->collection_title,
            'description_min' => $this->description_min,
           'is_published' => $this->is_published,
        ];
    }
}

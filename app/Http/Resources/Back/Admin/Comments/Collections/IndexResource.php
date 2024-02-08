<?php

namespace App\Http\Resources\Back\Admin\Comments\Collections;

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
            'collection_id' => $this->collection_id,
            'collection_name' => $this->collection->collection_title,
            'name' => $this->name,
            'rating' => $this->rating,
            'description' => $this->description,
            'approved' => $this->approved,
        ];
    }
}

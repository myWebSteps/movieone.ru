<?php

namespace App\Http\Resources\Front\Movies\Single;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class RelatedCollectionsResource extends JsonResource
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
                'collection_title' => $this->collection_title,
                ];

    }
}

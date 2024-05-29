<?php

namespace App\Http\Resources\Front\Collections;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

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
            'slug' => $this->slug,
            'description_min' => $this->description_min,
            'poster' => URL('/storage/collections/posters/' . $this->poster),
            'date' => Carbon::parse($this->updated_at)->format('d-m-Y H:i'),
        ];
    }
}

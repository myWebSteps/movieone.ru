<?php

namespace App\Http\Resources\Front\Collections;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class RelativeCollectionsResource extends JsonResource
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
            'description_min' =>$this->description_min,
            'slug' => $this->slug,
            'poster' => URL('/storage/collections/posters/' . $this->poster),
            'updated_at' => Carbon::parse($this->updated_at)->format('d-m-Y H:i'),
        ];
    }
}

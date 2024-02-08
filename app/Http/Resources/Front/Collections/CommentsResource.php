<?php

namespace App\Http\Resources\Front\Collections;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentsResource extends JsonResource
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
            'rating' => $this->rating,
            'description' => $this->description,
            'created_at' => Carbon::parse($this->created_at)->format('d-m-Y H:i'),
        ];
    }
}

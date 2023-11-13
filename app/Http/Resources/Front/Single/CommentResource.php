<?php

namespace App\Http\Resources\Front\Single;

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
            'rating' => $this->rating,
            'description' => $this->description,
            'updated_at' => $this->updated_at->diffForHumans()
        ];
    }
}

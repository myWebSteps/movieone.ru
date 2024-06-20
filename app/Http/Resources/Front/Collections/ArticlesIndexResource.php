<?php

namespace App\Http\Resources\Front\Collections;

use App\Http\Resources\Front\Collections\MoviesIndexResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Jenssegers\Agent\Agent;

class ArticlesIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if($this->movie !== null) {
            $movies = new MoviesIndexResource($this->movie);
            $movies = $movies->resolve();
        }else{
            $movies = null;
        };

        $image = $this->image;

        $agent = new Agent();

            if ($agent->isMobile())
            {
                $image = $this->image_min;
            }


        return [
            'article_id' => $this->id,
            'article_title' => $this->title,
            'description' => $this->description,
            'image' => URL('/storage/collections/articles/' . $image),
            'movies'=> $movies,
        ];
    }
}

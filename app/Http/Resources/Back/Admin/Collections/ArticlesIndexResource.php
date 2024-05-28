<?php

namespace App\Http\Resources\Back\Admin\Collections;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class ArticlesIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return [
            'article_title' => $this->title,
            'article_description' => $this->description,
            'article_image' => URL('/storage/collections/articles/' . $this->image),
            'article_movie'=> $this->movie_id,
            'movies_list' => DB::table('movies')->select('id', 'nameRu', 'nameEn', 'year')->orderBy('id', 'desc')->get(),
            'movies_filter' => ''
        ];
    }
}

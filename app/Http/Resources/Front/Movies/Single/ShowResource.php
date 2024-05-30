<?php

namespace App\Http\Resources\Front\Movies\Single;

use App\Http\Resources\Back\Admin\Comments\IndexResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Jenssegers\Agent\Agent;
use function PHPUnit\Framework\isEmpty;

class ShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $posterUrl = url('storage/movies' . $this->poster);

        $backdropUrl = url('storage/movies' . $this->backdrop_min);

        $agent = new Agent();

        if($this->backdrop != null) {

            if ($agent->isDesktop())
            {
                $backdropUrl = url('storage/movies' . $this->backdrop);
            }

        }else{
            $backdropUrl = null;
        }


        $soundtracks = [];


            foreach ($this->soundtracks as $key=>$item)
            {
                $soundtracks[$key]['file'] = url('storage/movies/soundtracks/'.$this->id.'/' . $item['file']);
                $soundtracks[$key]['title'] = $item['title'];

            }


        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'kinopoisk_id' => $this->kinopoisk_id,
            'posterUrl' => $posterUrl,
            'backdropUrl' => $backdropUrl,
            'trailers' => [
                'videos_count' => $this->trailers->count(),
                'videos' => $this->trailers
            ],
            'nameRu' => $this->nameRu,
            'nameEn' => $this->nameEn,
            'plot' => $this->plot,
            'actors_game' =>$this->actors_game,
            'atmosphere' =>$this->atmosphere,
            'rating' => $this->rate,
            'age_limits' => $this->age_limits,
            'category' => $this->category_id,
            'genres' => $this->genres,
            'type' => $this->type,
            'slogan' => $this->slogan,
            'description' => $this->description,
            'filmLength' => $this->duration,
            'endYear' => $this->year,
            'budget' => $this->budget,
            'countries' => $this->countries,
            'video_allowed' => $this->video_allowed,
            'meta_title' => $this->title->description,
            'meta_keywords' => $this->meta_keywords,
            'meta_description'=> $this->meta_description,
            'facts' => $this->int_facts->where('type', 'FACT')->where('spoiler', false),
            'bloopers' => $this->int_facts->where('type', 'BLOOPER')->where('spoiler', false),
            'spoilers' => $this->int_facts->where('spoiler', true),
            'facts_count' => $this->int_facts->count(),
            'soundtracks' => $soundtracks,
            'soundtracks_count' => $this->soundtracks->count(),
        ];
    }
}

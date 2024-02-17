<?php

namespace App\Http\Controllers\Back\Admin\Movies;

use App\Http\Controllers\Controller;

use App\Http\Requests\Back\Admin\Movies\StoreRequest;
use App\Models\CountryMovie;
use App\Models\Movie;
use App\Models\GenreMovie;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        //Poster Upload
            Image::make($data['poster'])
                ->fit(250, 370)
                ->save(storage_path('/app/public/movies/posters'.'/poster'.$data['kinopoiskId'].'.'.$data['poster']->getClientOriginalExtension()));
        //Backdrop Upload
        if(isset($data['backdrop'])){
            Image::make($data['backdrop'])
                ->fit(1300, 449)
                ->save(storage_path('/app/public/movies/backdrops'.'/backdrop'.$data['kinopoiskId'].'.'.$data['backdrop']->getClientOriginalExtension()));
        }

            $poster_path = '/posters'.'/poster'.$data['kinopoiskId'].'.'.$data['poster']->getClientOriginalExtension();

        if(isset($data['backdrop']))
            {
                $backdrop_path = '/backdrops'.'/backdrop'.$data['kinopoiskId'].'.'.$data['backdrop']->getClientOriginalExtension();
            }else
            {
                $backdrop_path = null;
            }

        if(!isset($data['budget']) || $data['budget'] == '' || $data['budget'] == 'undefined undefined')
        {
            $data['budget'] = null;
        }

            $movie = Movie::firstOrCreate(
                ['kinopoisk_id' => $data['kinopoiskId']],
                [
                    'kinopoisk_id' => $data['kinopoiskId'],
                    'nameRu' => $data['nameRu'],
                    'nameEn' => $data['nameEn'],
                    'age_limits' => $data['age_limits'],
                    'poster' => $poster_path,
                    'backdrop' => $backdrop_path,
                    'type' => $data['type'],
                    'category_id' => $data['category'],
                    'year' => $data['year'],
                    'duration' => $data['duration'],
                    'plot' => $data['plot'],
                    'default_plot' => $data['plot'],
                    'actors_game' => $data['actors_game'],
                    'default_actors_game' => $data['actors_game'],
                    'atmosphere' => $data['atmosphere'],
                    'default_atmosphere' => $data['atmosphere'],
                    'rate' => $data['rate'],
                    'budget' =>$data['budget'],
                    'slogan' => $data['slogan'],
                    'description' => $data['description'],
                    'title_id' => $data['title_id'],
                    'meta_keywords' => $data['meta_keywords'],
                    'meta_description' => $data['meta_description'],
                    ]
                );

        $movie->genres()->attach($data['genres']);
        $movie->countries()->attach($data['countries']);

        if(isset($data['trailers']) || !empty($data['trailers'])) {
            foreach($data['trailers'] as $item) {
                $movie->trailers()->create([
                    'movie_id' => $movie->id,
                    'url' => $item['url'],
                    'name' => $item['name'],
                    'site' => $item['site'],
                ]);
            }
        }

        return to_route('movies.index');
    }
}

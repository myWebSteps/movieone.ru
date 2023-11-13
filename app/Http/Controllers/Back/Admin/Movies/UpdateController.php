<?php

namespace App\Http\Controllers\Back\Admin\Movies;

use App\Http\Controllers\Controller;

use App\Http\Requests\Back\Admin\Movies\UpdateRequest;
use App\Models\Movie;
use Inertia\Inertia;
use Intervention\Image\Facades\Image;


class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Movie $movie)
    {
        $data = $request->validated();

        if(isset($data['poster']) && $data['poster'] !=null){
            $poster_path = '/posters'.'/poster'.$data['kinopoisk_id'].'.'.$data['poster']->getClientOriginalExtension();
            $data['poster'] = Image::make($data['poster'])
                ->fit(250, 370)
                ->save(storage_path('/app/public/posters'.'/poster'.$data['kinopoisk_id'].'.'.$data['poster']->getClientOriginalExtension()));
            $data['poster'] = $poster_path;
        }else{
            unset($data['poster']);
        }

        if(isset($data['backdrop']) && $data['backdrop'] !=null){
            $backdrop_path = '/backdrops'.'/backdrop'.$data['kinopoisk_id'].'.'.$data['backdrop']->getClientOriginalExtension();
            $data['backdrop'] = Image::make($data['backdrop'])
                ->fit(1300, 508)
                ->save(storage_path('/app/public/backdrops'.'/backdrop'.$data['kinopoisk_id'].'.'.$data['backdrop']->getClientOriginalExtension()));
        $data['backdrop'] = $backdrop_path;
        }else{
            unset($data['backdrop']);
        }


        $countries = $data['countries'];
        unset($data['countries']);
        $genres = $data['genres'];
        unset ($data['genres']);
        $trailers = $data['trailers'];
        unset($data['trailers']);

        $movie->update($data);

        $movie->genres()->sync($genres);
        $movie->countries()->sync($countries);

        $movie->trailers()->each(function ($trailer){
            $trailer->delete();
        });

        forEach($trailers as $item){
            $movie->trailers()->create([
                'movie_id' => $movie->id,
                'url' => $item['url'],
                'name' => $item['name'],
                'site' => $item['site'],
            ]);
        };


        return to_route('movies.index');
    }
}

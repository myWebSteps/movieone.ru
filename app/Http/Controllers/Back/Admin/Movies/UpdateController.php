<?php

namespace App\Http\Controllers\Back\Admin\Movies;

use App\Http\Controllers\Controller;

use App\Http\Requests\Back\Admin\Movies\UpdateRequest;
use App\Models\Comment;
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
                ->fit(250, 404)
                ->save(storage_path('/app/public/movies/posters'.'/poster'.$data['kinopoisk_id'].'.'.$data['poster']->getClientOriginalExtension()));
            $data['poster'] = $poster_path;
        }else{
            unset($data['poster']);
        }

        if(isset($data['backdrop']) && $data['backdrop'] !=null){
            $backdrop_path = '/backdrops'.'/backdrop'.$data['kinopoisk_id'].'.'.$data['backdrop']->getClientOriginalExtension();
            $data['backdrop'] = Image::make($data['backdrop'])
                ->fit(1535, 585)
                ->save(storage_path('/app/public/movies/backdrops'.'/backdrop'.$data['kinopoisk_id'].'.'.$data['backdrop']->getClientOriginalExtension()));
        $data['backdrop'] = $backdrop_path;
        }else{
            unset($data['backdrop']);
        }

        $movie->genres()->sync($data['genres']);
        $movie->countries()->sync($data['countries']);

        $movie->trailers()->each(function ($trailer){
            $trailer->delete();
        });

        if(isset($data['trailers']) || !empty($data['trailers'])) {
            foreach ($data['trailers'] as $item) {
                $movie->trailers()->create([
                    'movie_id' => $movie->id,
                    'url' => $item['url'],
                    'name' => $item['name'],
                    'site' => $item['site'],
                ]);
            };
        }

        if(!isset($data['budget']) || $data['budget'] == '' || $data['budget'] == 'undefined undefined')
        {
            $data['budget'] = null;
        }

        unset($data['countries']);
        unset ($data['genres']);
        unset($data['trailers']);

        $comments = Comment::where('approved', 1)
            ->where('movie_id', $data['id'])
            ->select('plot', 'actors_game', 'atmosphere')
            ->get()
            ->toArray();

        $rating = [];
        $rating['plot'] = $data['default_plot'];
        $rating['actors_game'] = $data['default_actors_game'];
        $rating['atmosphere'] = $data['default_atmosphere'];

        foreach ($comments as $item) {
            $rating['plot'] += $item['plot'];
            $rating['actors_game'] += $item['actors_game'];
            $rating['atmosphere'] += $item['atmosphere'];
        }


        $data['plot'] = round(($rating['plot'] / (count($comments) + 1)), 1);
        $data['actors_game'] = round(($rating['actors_game'] / (count($comments) + 1)), 1);
        $data['atmosphere'] = round(($rating['atmosphere'] / (count($comments) + 1)), 1);
        $data['rate'] = round(($data['plot'] + $data['actors_game'] + $data['atmosphere']) / 3, 1);

        $movie->update($data);

        return to_route('movies.index');
    }
}

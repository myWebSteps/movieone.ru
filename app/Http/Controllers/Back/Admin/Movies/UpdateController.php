<?php

namespace App\Http\Controllers\Back\Admin\Movies;

use App\Http\Controllers\Controller;

use App\Http\Requests\Back\Admin\Movies\UpdateRequest;
use App\Models\Comment;
use App\Models\Movie;
use App\Models\MovieSpinoff;
use Illuminate\Support\Facades\File;
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
            File::delete(storage_path('/app/public/movies' . $movie->backdrop));
            File::delete(storage_path('/app/public/movies' . $movie->backdrop_min));

            $backdrop_path = '/backdrops'.'/backdrop'.$data['kinopoisk_id'].'.'.$data['backdrop']->getClientOriginalExtension();
            Image::make($data['backdrop'])
                ->fit(1200, 450)
                ->save(storage_path('/app/public/movies/backdrops'.'/backdrop'.$data['kinopoisk_id'].'.'.$data['backdrop']->getClientOriginalExtension()));
            $backdrop_path_min = '/backdrops'.'/backdrop'.$data['kinopoisk_id'].'_min.'.$data['backdrop']->getClientOriginalExtension();
            Image::make($data['backdrop'])
                ->fit(400, 150)
                ->save(storage_path('/app/public/movies/backdrops'.'/backdrop'.$data['kinopoisk_id'].'_min.'.$data['backdrop']->getClientOriginalExtension()));
            $data['backdrop'] = $backdrop_path;
            $data['backdrop_min'] = $backdrop_path_min;
        }else{
            unset($data['backdrop']);
        }

        $movie->genres()->sync($data['genres']);
        $movie->countries()->sync($data['countries']);

        $spinOffToDelete = MovieSpinoff::where('movie_id', $data['id'])->get();

        foreach ($spinOffToDelete as $item)
        {
            $item->delete();
        }
        if(isset($data['spin_off'])){
            foreach ($data['spin_off'] as $item) {
                MovieSpinoff::create([
                    'movie_id' => $movie->id,
                    'spin_off' => $item,
                ]);
            }
        }

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
        unset($data['spin_off']);

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

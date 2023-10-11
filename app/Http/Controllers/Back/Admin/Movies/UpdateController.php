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

        if($data['poster'] != null){
            Image::make($data['poster'])
                ->fit(684, 1000)
                ->save(storage_path('/app/public/files'.'/poster'.$data['kinopoisk_id'].'.'.$data['poster']->getClientOriginalExtension()));
        }

        unset($data['poster']);

        $countries = $data['countries'];
        unset($data['countries']);
        $genres = $data['genres'];
        unset ($data['genres']);

        $movie->update(
                $data
                );

        $movie->genres()->sync($genres);
        $movie->countries()->sync($countries);

        return to_route('movies.index');

    }
}

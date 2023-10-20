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

            Image::make($data['poster'])
                ->fit(684, 1000)
                ->save(storage_path('/app/public/files'.'/poster'.$data['kinopoiskId'].'.'.$data['poster']->getClientOriginalExtension()));


            $poster_path = '/files'.'/poster'.$data['kinopoiskId'].'.'.$data['poster']->getClientOriginalExtension();

            $movie = Movie::firstOrCreate(
                ['kinopoisk_id' => $data['kinopoiskId']],
                [
                    'kinopoisk_id' => $data['kinopoiskId'],
                    'nameRu' => $data['nameRu'],
                    'nameEn' => $data['nameEn'],
                    'age_limits' => $data['age_limits'],
                    'poster' => $poster_path,
                    'trailer' => $data['trailer'],
                    'type' => $data['type'],
                    'category_id' => $data['category'],
                    'year' => $data['year'],
                    'duration' => $data['duration'],
                    'rate' => $data['rate'],
                    'slogan' => $data['slogan'],
                    'description' => $data['description'],
                    ]
                );

        $movie->genres()->attach($data['genres']);
        $movie->countries()->attach($data['countries']);

    }
}

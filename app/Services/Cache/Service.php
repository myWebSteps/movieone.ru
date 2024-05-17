<?php

namespace App\Services\Cache;

use App\Models\Category;
use App\Models\Collection;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Support\Facades\Cache;

class Service
{
    public function resetCache()
    {
        Cache::flush();

        $movies = Movie::all()->each(function ($movie) {
            $movie['countries'] = $movie->countries;
            $movie['genres'] = $movie->genres;
            $movie['spinOff'] = $movie->spinOff;
            $movie['comments'] = $movie->comments->where('approved', 1);
            $movie['collections'] = $movie->collections->where('is_published', 1);
        });

        Cache::put('movies', $movies);

        Cache::put('categories', Category::all());

        Cache::put('countries', Country::all());

        Cache::put('genres', Genre::all());

        $collections = Collection::where('is_published', 1)->get()->each(function ($collection) {
            $collection['comments'] = $collection->comments->where('approved', 1);
        });

        Cache::put("collections", $collections);
    }
}

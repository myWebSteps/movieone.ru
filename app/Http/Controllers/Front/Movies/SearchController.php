<?php

namespace App\Http\Controllers\Front\Movies;

use App\Http\Controllers\Controller;
use App\Http\Filters\MovieFilter;
use App\Http\Requests\Front\FrontLayout\SearchRequest;
use App\Http\Resources\Front\Movies\Index\IndexResource;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function __invoke(SearchRequest $request)
    {
        $data = $request->validated();

        $filter = app()->make(MovieFilter::class, ['queryParams' => array_filter($data)]);

        $movies = IndexResource::collection(Movie::filter($filter)->orderBy('id', 'desc')->take(18)->get())->resolve();

        return Inertia::render('Front/Movies/Search', compact( 'movies', 'data'));

    }
}

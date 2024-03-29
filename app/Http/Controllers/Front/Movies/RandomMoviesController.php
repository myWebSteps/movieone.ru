<?php

namespace App\Http\Controllers\Front\Movies;

use App\Http\Controllers\Controller;
use App\Http\Resources\Front\Movies\RandomMovies\CollectionsResource;
use App\Http\Resources\Front\Movies\RandomMovies\IndexResource;
use App\Models\Category;
use App\Models\Collection;
use Inertia\Inertia;

class RandomMoviesController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();

        $data = IndexResource::collection($categories)->resolve();

        return Inertia::render('Front/Movies/RandomMovies', compact('data'));
    }
}

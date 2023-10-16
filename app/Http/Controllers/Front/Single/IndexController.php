<?php

namespace App\Http\Controllers\Front\Single;

use App\Http\Controllers\Controller;
use App\Http\Resources\Front\Single\RelatedMoviesResource;
use App\Http\Resources\Front\Single\ShowResource;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = Movie::where('slug', $request->movie)->firstOrFail();

        $result = new ShowResource($data);

        $movie = $result->resolve();

        $genre = Genre::where('id', $result->genres[0]->id)->first();

        $resultRelatedMovies = $genre->movies->whereNotIn('slug', $request->movie)->shuffle()->take(4);

        $relatedMovies = RelatedMoviesResource::collection($resultRelatedMovies)->resolve();

        return Inertia::render('Front/Single', compact('movie', 'relatedMovies'));
    }
}

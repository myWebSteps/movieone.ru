<?php

namespace App\Http\Controllers\Back\Admin\Movies;

use App\Http\Controllers\Controller;
use App\Http\Resources\Back\Admin\Movies\EditResource;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Title;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EditController extends Controller
{
    public function __invoke(Request $request)
    {
        $result = Movie::where('id', $request->movie)->first();

        $movie = new EditResource($result);
        $categories = Category::all();
        $genres = Genre::where('category_id', $movie->category_id)->get();
        $countries = Country::all();
        $titles = Title::all();
        $movie = $movie->resolve();
        $movies_list = Movie::all('id', 'kinopoisk_id', 'nameRu', 'year');
        return Inertia::render('Back/Admin/Movies/Edit', compact('movie', 'categories', 'genres', 'countries', 'titles', 'movies_list'));
    }
}

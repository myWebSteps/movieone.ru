<?php

namespace App\Http\Controllers\Back\Admin\Movies;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Title;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CreateController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();
        $countries = Country::all();
        $titles = Title::all();
        $movies_list = DB::table('movies')->select('id', 'kinopoisk_id', 'nameRu', 'year')->orderBy('id', 'desc')->get();

       return Inertia::render('Back/Admin/Movies/Create', compact('categories', 'countries', 'titles', 'movies_list'));
    }
}

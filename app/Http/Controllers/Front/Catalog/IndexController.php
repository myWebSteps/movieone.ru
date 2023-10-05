<?php

namespace App\Http\Controllers\Front\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Filters\MovieFilter;
use App\Http\Resources\Front\Catalog\IndexResource;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->all();

        $category = Category::where('id', $request->get('category'))->first();

        $genres = Genre::where('category_id', $request->get('category'))->get();

        $filter = app()->make(MovieFilter::class, ['queryParams' => array_filter($data)]);

        $movies = Movie::filter($filter)->orderBy($request->get('order'), 'desc')->paginate(20, ['*'], 'page', $request->get('page'));

        IndexResource::collection($movies)->resolve();

        return Inertia::render('Front/Catalog', compact('genres', 'movies', 'category'));

    }
}

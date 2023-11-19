<?php

namespace App\Http\Controllers\Front\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Filters\GenresFilter;
use App\Http\Filters\MovieFilter;
use App\Http\Resources\Front\Catalog\GenresResource;
use App\Http\Resources\Front\Catalog\IndexResource;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Inertia\Inertia;
use function Symfony\Component\ErrorHandler\ErrorRenderer\abbrClass;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->all();

        if(!isset($data['category']))
        {
            abort(404);
        };
        if(!isset($data['type']))
        {
            $data['type'] = null;
        };
        if(!isset($data['genre']))
        {
            $data['genre'] = null;
        };
        if(!isset($data['page']))
        {
            $data['page'] = 1;
        };
        if(!isset($data['genres_filter']))
        {
            $data['genres_filter'] = null;
        };

        $category = Category::where('slug', $request->get('category'))->first();

        //Types count
        $typesCount = [];
        $allTypesCount = Movie::where('category_id', $category->id)->count();
        $typesCount['feature'] = Movie::where('category_id', $category->id)->where('type', 2)->count();
        $typesCount['serial'] = Movie::where('category_id', $category->id)->where('type', 3)->count();
        $typesCount['mini_serial'] = Movie::where('category_id', $category->id)->where('type', 4)->count();
        //End Types Count



        //Movies filter
        $filter = app()->make(MovieFilter::class, ['queryParams' => array_filter($data)]);
        $movies = Movie::filter($filter)->orderBy($request->get('order'), 'desc')->paginate(2, ['*'], 'page', $request->get('page'));
        IndexResource::collection($movies)->resolve();
        //End of Movies Filter

        //Genres Filter
        $genres_filter = app()->make(GenresFilter::class, ['queryParams' => array_filter($data)]);
        $genres_result = Genre::where('category_id', $category->id)->filter($genres_filter)
            ->orderBy('title', 'ASC')
            ->get();

        //Genres count
        $getGenres = Genre::where('category_id', $category->id)->get();
        $allGenresCount = [];
        foreach($getGenres as $item){
            $allGenresCount[] = $item->movies->count();
        };
        $allGenresCount = $allTypesCount;

        $genres = GenresResource::collection($genres_result)->resolve();
        //End Genres count

        //End of Genres Filter


        return Inertia::render('Front/Catalog', compact('genres', 'allGenresCount', 'allTypesCount', 'typesCount', 'movies', 'category', 'data'));

    }
}

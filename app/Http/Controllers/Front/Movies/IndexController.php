<?php

namespace App\Http\Controllers\Front\Movies;

use App\Http\Controllers\Controller;
use App\Http\Filters\CountriesFilter;
use App\Http\Filters\GenresFilter;
use App\Http\Filters\MovieFilter;
use App\Http\Resources\Front\Movies\Index\GenresResource;
use App\Http\Resources\Front\Movies\Index\IndexResource;
use App\Models\Category;
use App\Models\Country;
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
        if(!isset($data['country']))
        {
            $data['country'] = null;
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
        $originalYearFrom = Movie::where('category_id', $category->id)->min('year');
        $originalYearTo = Movie::where('category_id', $category->id)->max('year');

        if(!isset($data['yearFrom']))
        {
            $data['yearFrom'] = $originalYearFrom;
        };
        if(!isset($data['yearTo']))
        {
            $data['yearTo'] = $originalYearTo;
        };
        if((isset($data['yearFrom']) && isset($data['yearTo'])) && $data['yearTo'] < $data['yearFrom'])
        {
            $data['yearFrom'] = $originalYearFrom;
            $data['yearTo'] = $originalYearTo;
        }
        //totalCount
        $totalCount = Movie::where('category_id', $category->id)->count();

        //Types count
        $typesCount = [];
        $typesCount['feature'] = Movie::where('category_id', $category->id)->where('type', 2)->count();
        $typesCount['serial'] = Movie::where('category_id', $category->id)->where('type', 3)->count();
        $typesCount['mini_serial'] = Movie::where('category_id', $category->id)->where('type', 4)->count();
        //End Types Count

        //Movies filter
        $filter = app()->make(MovieFilter::class, ['queryParams' => array_filter($data)]);
        $movies = Movie::filter($filter)->orderBy($request->get('order'), 'desc')->paginate(18, ['*'], 'page', $request->get('page'));
        IndexResource::collection($movies)->resolve();
        //End of Movies Filter

        //Genres Filter
        $genres_filter = app()->make(GenresFilter::class, ['queryParams' => array_filter($data)]);
        $genres_result = Genre::where('category_id', $category->id)->filter($genres_filter)
            ->orderBy('title', 'ASC')
            ->get();

        //Countries Filter
        $countries_filter = app()->make(CountriesFilter::class, ['queryParams' => array_filter($data)]);
        $countries_result = Country::filter($countries_filter)
            ->orderBy('title', 'ASC')
            ->get();

        $genres = GenresResource::collection($genres_result)->resolve();
        //End Genres count


        //Countries
        $countries = [];
        foreach ($countries_result as $item)
        {
            $countriesItem = [];
            $countriesItem['id'] = $item->id;
            $countriesItem['title'] = $item->title;
            $countriesItem['slug'] = $item->slug;
            $countriesItem['count'] = $item->movies->where('category_id', $category->id)->count();
            $countries[] = $countriesItem;
        }

        return Inertia::render('Front/Movies/Index', compact('genres', 'totalCount', 'typesCount', 'movies', 'category', 'data', 'originalYearFrom', 'originalYearTo', 'countries'));

    }
}

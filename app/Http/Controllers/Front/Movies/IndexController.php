<?php

namespace App\Http\Controllers\Front\Movies;

use App\Http\Controllers\BaseControllers\Front\MoviesController;
use App\Http\Filters\CountriesFilter;
use App\Http\Filters\GenresFilter;
use App\Http\Filters\MovieFilter;
use App\Http\Resources\Front\Movies\Index\GenresResource;
use App\Http\Resources\Front\Movies\Index\IndexResource;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use function Symfony\Component\ErrorHandler\ErrorRenderer\abbrClass;

class IndexController extends MoviesController
{
    public function __invoke(Request $request)
    {
        $data = $request->all();

        $data = $this->filterService->alignData($data);

        $category = Cache::get('categories')->where('slug', $data['category'])->first();
        //Data Change Slug to id
        $data['category_id'] = $category->id;

        $originalYearFrom = Cache::get("movies")->where('category_id', $category->id)->min('year');

        $originalYearTo = Cache::get("movies")->where('category_id', $category->id)->max('year');

        $data = $this->filterService->alignDataWithYear($data, $originalYearFrom, $originalYearTo);

        //totalCount
        $totalCount = Cache::get("movies")->where('category_id', $category->id)->count();

        //Types count
        $typesCount = $this->filterService->typesCount($category);

        //Movies filter
        $filter = app()->make(MovieFilter::class, ['queryParams' => array_filter($data)]);
        $result = Movie::filter($filter)->orderBy($request->get('order'), 'desc')->paginate(20, ['*'], 'page', $request->get('page'));
        $movies = IndexResource::collection($result);
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
        $countries = $this->filterService->countries($countries_result, $category);


        $genres = GenresResource::collection($genres_result)->resolve();
        //End Genres count


        return Inertia::render('Front/Movies/Index', compact('genres', 'totalCount', 'typesCount', 'movies', 'category', 'data', 'originalYearFrom', 'originalYearTo', 'countries'));

    }
}

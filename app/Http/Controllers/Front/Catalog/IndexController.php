<?php

namespace App\Http\Controllers\Front\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Filters\MovieFilter;
use App\Http\Resources\API\Movies\IndexResourse;
use App\Http\Resources\Front\Home\IndexResource;
use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->all();

        $filter = app()->make(MovieFilter::class, ['queryParams' => array_filter($data)]);

        $movies = Movie::filter($filter)->orderBy($request->get('order'), 'desc')->paginate(20, ['*'], 'page', $request->get('page'));

        return IndexResourse::collection($movies);


        dd($request->get('category'));
    }
}

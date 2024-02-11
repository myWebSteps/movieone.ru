<?php

namespace App\Http\Controllers\Back\Admin\Collections;

use App\Http\Controllers\Controller;

use App\Http\Requests\Back\Admin\Collections\FilteredMoviesRequest;
use App\Http\Resources\Back\Admin\Movies\IndexResource;
use App\Models\CountryMovie;
use App\Models\Movie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Intervention\Image\Facades\Image;


class FilteredMoviesController extends Controller
{
    public function __invoke(FilteredMoviesRequest $request)
    {
        $data = $request->validated();

        if(isset($data['query_filter']))
        {
            $result = $data['query_filter'];
            $movies = Movie::where('nameRu', 'like', "%$result%")
                ->orWhere('nameEn', 'like', "%$result%")
                ->select('id', 'nameRu', 'nameEn', 'year')->get();
        }else {
            $movies = Movie::all('id', 'nameRu', 'nameEn', 'year');
        }

        return $movies;
    }
}

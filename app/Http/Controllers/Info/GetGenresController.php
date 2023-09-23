<?php

namespace App\Http\Controllers\Info;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\Subcategories\IndexResourse;
use App\Http\Resources\Info\GenresResource;
use App\Models\Genre;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class GetGenresController extends Controller
{
    public function __invoke(Request $request)
    {
        $category = $request->get('category');

        $genres = Genre::where('category_id', $category)->get();

        return GenresResource::collection($genres)->resolve();

    }
}

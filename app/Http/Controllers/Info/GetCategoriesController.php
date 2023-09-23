<?php

namespace App\Http\Controllers\Info;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\Categories\IndexResourse;
use App\Models\Category;
use Illuminate\Http\Request;

class GetCategoriesController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();

        return $categories;
    }
}

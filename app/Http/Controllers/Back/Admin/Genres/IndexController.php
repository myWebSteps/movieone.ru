<?php

namespace App\Http\Controllers\Back\Admin\Genres;

use App\Http\Controllers\Controller;
use App\Http\Resources\Back\Admin\Genres\IndexResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke()
    {
       $categories = Category::all();

       $data = IndexResource::collection($categories)->resolve();

       return Inertia::render('Back/Admin/Genres/Index', compact('data'));
    }
}

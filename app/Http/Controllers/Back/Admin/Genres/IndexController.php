<?php

namespace App\Http\Controllers\Back\Admin\Genres;

use App\Http\Controllers\Controller;
use App\Http\Resources\Back\Admin\Genres\IndexResource;
use App\Models\Category;
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

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\Front\Home\IndexResource;
use App\Models\Category;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();

        $data = IndexResource::collection($categories)->resolve();

        return Inertia::render('Front/Home', compact('data'));
    }
}

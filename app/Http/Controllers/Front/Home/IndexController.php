<?php

namespace App\Http\Controllers\Front\Home;

use App\Http\Controllers\Controller;
use App\Http\Resources\Front\Home\IndexResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();

        $data = IndexResource::collection($categories)->resolve();

        return Inertia::render('Front/Home/Index', compact('data'));
    }
}

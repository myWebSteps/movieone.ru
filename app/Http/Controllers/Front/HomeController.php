<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\Front\Home\CollectionsResource;
use App\Http\Resources\Front\Home\IndexResource;
use App\Models\Category;
use App\Models\Collection;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();

        $data = IndexResource::collection($categories)->resolve();

        $result = Collection::where('is_published', '1')->select('id', 'collection_title', 'slug', 'poster', 'description_min')->take(4)->get();

        $collections = CollectionsResource::collection($result)->resolve();

        return Inertia::render('Front/Home', compact('data', 'collections'));
    }
}

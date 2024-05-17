<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\Front\Home\CollectionsResource;
use App\Http\Resources\Front\Home\IndexResource;
use App\Models\Category;
use App\Models\Collection;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke()
    {
        $categories = Cache::get('categories');

        $data = IndexResource::collection($categories)->resolve();

        $result = Cache::get('collections')->take(4);

        $collections = CollectionsResource::collection($result)->resolve();

        return Inertia::render('Front/Home', compact('data', 'collections'));
    }
}

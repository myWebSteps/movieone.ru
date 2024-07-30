<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\Front\Home\CollectionsResource;
use App\Http\Resources\Front\Home\IndexResource;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Jenssegers\Agent\Agent;

class NotFoundController extends Controller
{
    public function __invoke()
    {
        $categories = Cache::get('categories');

        $data = IndexResource::collection($categories)->resolve();

        $result = Cache::get('collections')->sortBy([['updated_at', 'DESC']])->take(4);

        $collections = CollectionsResource::collection($result)->resolve();

        return Inertia::render('Front/NotFound', compact('data', 'collections'));
    }
}

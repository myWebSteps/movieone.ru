<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\Front\Home\CollectionsResource;
use App\Http\Resources\Front\Home\IndexResource;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Jenssegers\Agent\Agent;

class HomeController extends Controller
{
    public function __invoke()
    {
        $categories = Cache::get('categories');

        $data = IndexResource::collection($categories)->resolve();

        $result = Cache::get('collections')->take(4);

        $collections = CollectionsResource::collection($result)->resolve();

        $agent = new Agent();

        $coverImg = "";

        if($agent->isMobile())
        {
            $coverImg = "/img/cover_min.webp";
        }elseif($agent->isTablet())
        {
            $coverImg = "/img/cover_min.webp";
        }elseif ($agent->isDesktop())
        {
            $coverImg = "/img/cover.webp";
        };


        return Inertia::render('Front/Home', compact('data', 'collections', 'coverImg'));
    }
}

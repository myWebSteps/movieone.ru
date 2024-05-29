<?php

namespace App\Http\Controllers\Front\Collections;

use App\Http\Controllers\Controller;
use App\Http\Resources\Front\Collections\IndexResource;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;


class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        if(!isset($request['page']))
        {
            $request['page'] = 1;
        };
        $page = $request['page'];


        $result = Collection::where('is_published', '1')->orderBy('updated_at', 'DESC')->select('id', 'collection_title', 'poster', 'slug', 'description_min', 'updated_at')->paginate(8, ['*'], 'page', $page);


        $data = IndexResource::collection($result);

        return Inertia::render('Front/Collections/Index', compact('data'));
    }
}

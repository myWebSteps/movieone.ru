<?php

namespace App\Http\Controllers\Front\Collections;

use App\Http\Controllers\Controller;
use App\Http\Resources\Front\Collections\IndexResource;
use App\Models\Collection;
use Illuminate\Http\Request;
use Inertia\Inertia;


class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        if(!isset($request['page']))
        {
            $request['page'] = 1;
        };

        $result = Collection::where('is_published', '1')->orderBy('id', 'DESC')->select('id', 'collection_title', 'poster', 'slug', 'description_min')->paginate(1, ['*'], 'page', $request['page']);

        $data = IndexResource::collection($result);

        return Inertia::render('Front/Collections/Index', compact('data'));
    }
}

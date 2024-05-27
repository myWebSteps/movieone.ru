<?php

namespace App\Http\Controllers\Front\Collections;

use App\Http\Controllers\Controller;
use App\Http\Resources\Front\Collections\RelativeCollectionsResource;
use App\Http\Resources\Front\Collections\SingleIndexResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;


class ShowController extends Controller
{
    public function __invoke(Request $request)
    {

        try {
            $result = Cache::get('collections')->where('slug', $request->collection)->firstOrFail();
        } catch (\Exception $e) {
            abort(404);
        }

        $collection = new SingleIndexResource($result);

        $relCollections = Cache::get('collections')
            ->where('slug', '!=', $request->collection)->sortBy([['id', 'DESC']])->take(4);

        $relativeCollections = RelativeCollectionsResource::collection($relCollections)->resolve();

        $data = $collection->resolve();

        return Inertia::render('Front/Collections/Single', compact('data', 'relativeCollections'));
    }
}

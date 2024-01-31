<?php

namespace App\Http\Controllers\Front\Collections;

use App\Http\Controllers\Controller;
use App\Http\Resources\Front\Collections\IndexResource;
use App\Http\Resources\Front\Collections\SingleIndexResource;
use App\Models\Collection;
use Illuminate\Http\Request;
use Inertia\Inertia;


class ShowController extends Controller
{
    public function __invoke(Request $request)
    {
        $result = Collection::where('is_published', '1')->where('slug', $request->collection)->first();

        $collection = new SingleIndexResource($result);

        $data = $collection->resolve();

        return Inertia::render('Front/Collections/Single', compact('data'));
    }
}

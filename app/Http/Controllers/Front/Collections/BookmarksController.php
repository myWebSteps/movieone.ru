<?php

namespace App\Http\Controllers\Front\Collections;

use App\Http\Controllers\Controller;

use App\Http\Requests\Front\Collections\Single\BookmarksRequest;
use App\Http\Resources\Front\Collections\BookmarksResource;
use Illuminate\Support\Facades\Cache;

class BookmarksController extends Controller
{
    public function __invoke(BookmarksRequest $request)
    {
        $data = $request->validated();

        $ids = explode(',', $data['id']);

        $result = Cache::get("collections")->whereIn('id', $ids)->sortBy([['collection_title', 'ASC']]);

        return BookmarksResource::collection($result);
    }
}

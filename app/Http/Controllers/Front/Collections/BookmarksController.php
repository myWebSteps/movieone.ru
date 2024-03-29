<?php

namespace App\Http\Controllers\Front\Collections;

use App\Http\Controllers\Controller;

use App\Http\Requests\Front\Collections\Single\BookmarksRequest;
use App\Http\Resources\Front\Collections\BookmarksResource;
use App\Models\Collection;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookmarksController extends Controller
{
    public function __invoke(BookmarksRequest $request)
    {
        $data = $request->validated();

        $ids = explode(',', $data['id']);

        $result = Collection::whereIn('id', $ids)->orderBy('collection_title', 'ASC')->get();

        return BookmarksResource::collection($result);
    }
}

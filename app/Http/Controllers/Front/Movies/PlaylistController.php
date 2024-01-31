<?php

namespace App\Http\Controllers\Front\Movies;

use App\Http\Controllers\Controller;
use App\Http\Filters\MovieFilter;
use App\Http\Requests\Front\Movies\Single\PlaylistRequest;
use App\Http\Resources\Front\Movies\Single\PlaylistResource;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaylistController extends Controller
{
    public function __invoke(PlaylistRequest $request)
    {
        $data = $request->validated();

        $ids = explode(',', $data['id']);

        $result = Movie::whereIn('id', $ids)->orderBy('nameRu', 'ASC')->get();

        return PlaylistResource::collection($result);
    }
}

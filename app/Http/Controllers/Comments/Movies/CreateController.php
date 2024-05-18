<?php

namespace App\Http\Controllers\Comments\Movies;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comments\CreateRequest;
use App\Models\Comment;

class CreateController extends Controller
{
    public function __invoke(CreateRequest $request)
    {
        $data = $request->validated();

        Comment::create([
            'movie_id' => $data['id'],
            'name' => $data['name'],
            'plot' => $data['plot'],
            'actors_game' => $data['actors_game'],
            'atmosphere' => $data['atmosphere'],
            'rating' => $data['rating'],
            'description' => $data['description'],
        ]);

    }
}

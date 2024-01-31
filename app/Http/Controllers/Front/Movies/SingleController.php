<?php

namespace App\Http\Controllers\Front\Movies;

use App\Http\Controllers\Controller;
use App\Http\Resources\Front\Movies\Single\CommentResource;
use App\Http\Resources\Front\Movies\Single\RelatedMoviesResource;
use App\Http\Resources\Front\Movies\Single\ShowResource;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Inertia\Inertia;
use function Monolog\toArray;

class SingleController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = Movie::where('slug', $request->movie)->firstOrFail();

        $result = new ShowResource($data);

        $movie = $result->resolve();

        $genre = Genre::where('id', $result->genres[0]->id)->first();

        $resultRelatedMovies = $genre->movies->whereNotIn('slug', $request->movie)->shuffle()->take(4);

        $comments = [];
        $comments['comments'] = CommentResource::collection(Comment::where('movie_id', $data->id)->where('approved', 1)->get())->resolve();
        $comments['total_count'] = Comment::where('movie_id', $data->id)->where('approved', 1)->count();
        $comments['values'] = Comment::where('movie_id', $data->id)->where('approved', 1)->select('rating')->get()->toArray();
        $comments['score'] = 0;

        foreach($comments['values'] as $item){
            $comments['score']  =  $comments['score'] + $item['rating'];
        }
        if($comments['score'] != 0) {
            $comments['score'] = round($comments['score'] / $comments['total_count'], 2);
        }
        $relatedMovies = RelatedMoviesResource::collection($resultRelatedMovies)->resolve();

        return Inertia::render('Front/Movies/Single', compact('movie', 'comments', 'relatedMovies'));
    }
}

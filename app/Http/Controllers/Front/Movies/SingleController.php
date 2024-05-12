<?php

namespace App\Http\Controllers\Front\Movies;

use App\Http\Controllers\Controller;
use App\Http\Resources\Front\Movies\Single\CommentResource;
use App\Http\Resources\Front\Movies\Single\RelatedCollectionsResource;
use App\Http\Resources\Front\Movies\Single\RelatedMoviesResource;
use App\Http\Resources\Front\Movies\Single\ShowResource;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Inertia\Inertia;
use phpDocumentor\Reflection\Location;
use function Monolog\toArray;
use function Symfony\Component\String\length;

class SingleController extends Controller
{
    public function __invoke(Request $request)
    {
        $ip = request()->ip(); //ip of the user which is currently visiting.
        $location = \Location::get($ip);    

        $data = Movie::where('slug', $request->movie)->firstOrFail();

        $result = new ShowResource($data);

        $movie = $result->resolve();

        $genre = Genre::where('id', $result->genres[0]->id)->first();

        $spinMovies = RelatedMoviesResource::collection($data->spinOff)->resolve();

        $kinopoiskIds = [];

        foreach($data->spinOff as $item)
        {
            $kinopoiskIds[] = $item['kinopoisk_id'];
        }

        $resultRelatedMovies = $genre->movies->whereNotIn('slug', $request->movie)->whereNotIn('kinopoisk_id', $kinopoiskIds)->shuffle()->take(6);

        $comments = CommentResource::collection(Comment::where('movie_id', $data->id)->where('approved', 1)->orderBy('id', 'DESC')->get())->resolve();

        $commentsCount = Comment::where('movie_id', $data->id)->where('approved', 1)->count();

        $relatedMovies = RelatedMoviesResource::collection($resultRelatedMovies)->resolve();

        $relatedCollections = RelatedCollectionsResource::collection($data->collections()->where('is_published', '1')->get())->resolve();

        return Inertia::render('Front/Movies/Single', compact('movie', 'comments', 'commentsCount', 'relatedMovies', 'spinMovies', 'relatedCollections', 'location'));
    }
}

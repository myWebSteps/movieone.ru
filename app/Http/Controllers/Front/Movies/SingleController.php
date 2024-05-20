<?php

namespace App\Http\Controllers\Front\Movies;

use App\Http\Controllers\BaseController;
use App\Http\Resources\Front\Movies\Single\CommentResource;
use App\Http\Resources\Front\Movies\Single\RelatedCollectionsResource;
use App\Http\Resources\Front\Movies\Single\RelatedMoviesResource;
use App\Http\Resources\Front\Movies\Single\ShowResource;
use \Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Inertia\Inertia;
use function Monolog\toArray;
use function Symfony\Component\String\length;

class SingleController extends BaseController
{
    public function __invoke(Request $request)
    {
        //Ip User
        $ip = request()->ip(); //ip of the user which is currently visiting.
        $location = $this->service::ip_info($ip);
        try {
            $data = Cache::get('movies')->where('slug', $request->movie)->firstOrFail();
        } catch (\Exception $e) {
            abort(404);
        }

        $result = new ShowResource($data);

        $movie = $result->resolve();

        $genre = Cache::get("genres")->where('id', $result->genres[0]->id)->first();

        $spinMovies = RelatedMoviesResource::collection($data->spinOff)->resolve();

        $kinopoiskIds = [];

        foreach ($data->spinOff as $item) {
            $kinopoiskIds[] = $item['kinopoisk_id'];
        }


        $resultRelatedMovies = $genre->movies->whereNotIn('slug', $request->movie)->whereNotIn('kinopoisk_id', $kinopoiskIds)->shuffle()->take(5);

        $comments = CommentResource::collection($data->comments->sortBy([['id', 'DESC']]))->resolve();

        $commentsCount = $data->comments->count();

        $relatedMovies = RelatedMoviesResource::collection($resultRelatedMovies)->resolve();

        $relatedCollections = RelatedCollectionsResource::collection($data->collections)->resolve();

        return Inertia::render('Front/Movies/Single', compact('movie', 'comments', 'commentsCount', 'relatedMovies', 'spinMovies', 'relatedCollections', 'location'));
    }
}

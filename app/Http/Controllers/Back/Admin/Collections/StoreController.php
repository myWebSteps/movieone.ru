<?php

namespace App\Http\Controllers\Back\Admin\Collections;

use App\Http\Controllers\Controller;

use App\Http\Requests\Back\Admin\Collections\StoreRequest;
use App\Models\Article;
use App\Models\Collection;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;



class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $image_name = Carbon::now()->getTimestampMs() . '.' . $data['poster']->getClientOriginalExtension();
        Image::make($data['poster'])
            ->fit(342, 500)
            ->save(storage_path('/app/public/collections/posters/' . $image_name));
        $data['poster'] = $image_name;

        $collection = Collection::firstOrCreate(
            ['collection_title' => $data['collection_title']],
            [
                'collection_title' => $data['collection_title'],
                'description_min' => $data['description_min'],
                'description' => $data['description'],
                'poster' => $data['poster'],
                'meta_title' => $data['meta_title'],
                'meta_keywords' => $data['meta_keywords'],
                'meta_description' => $data['meta_description']
            ]
        );

        $moviesArr = [];

        foreach($data['articles'] as $article){

            $image_name = Carbon::now()->getTimestampMs() . '.' . $article['article_image']->getClientOriginalExtension();

            Image::make($article['article_image'])
                ->fit(1300, 400)
                ->save(storage_path('/app/public/collections/articles/'. $image_name));

            $moviesArr[] = $article['article_movie'];

            Article::create([
                'collection_id' => $collection->id,
                'title' => $article['article_title'],
                'description' => $article['article_description'],
                'image' => $image_name,
                'movie_id' => $article['article_movie']
            ]);

        };

        $collection->movies()->attach($moviesArr);

        return to_route('collections.index');
    }
}

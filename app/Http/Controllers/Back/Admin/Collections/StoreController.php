<?php

namespace App\Http\Controllers\Back\Admin\Collections;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;

use App\Http\Requests\Back\Admin\Collections\StoreRequest;
use App\Models\Article;
use App\Models\Collection;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;



class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $image_name = Carbon::now()->getTimestampMs() . '.' . 'webp';
        Image::make($data['poster'])
            ->fit(267, 400)
            ->encode('webp', 90)
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

            $image_name = Carbon::now()->getTimestampMs() . '.' . 'webp';

            Image::make($article['article_image'])
                ->fit(1200, 450)
                ->encode('webp', 90)
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

        $this->service->resetCache();

        return to_route('collections.index');
    }
}

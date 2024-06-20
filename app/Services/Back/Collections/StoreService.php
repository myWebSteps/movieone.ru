<?php

namespace App\Services\Back\Collections;

use App\Models\Article;
use App\Models\Collection;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

Class StoreService
{
    public function store($data)
    {
        $image_name = Carbon::now()->getTimestampMs() . '.' . 'webp';
        Image::make($data['poster'])
            ->fit(135, 200)
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

            $image_name = Carbon::now()->getTimestampMs() . '.webp';
            $image_name_min = 'min_' . Carbon::now()->getTimestampMs() . '.webp';

            Image::make($article['article_image'])
                ->fit(1200, 450)
                ->encode('webp', 90)
                ->save(storage_path('/app/public/collections/articles/'. $image_name));

            Image::make($article['article_image'])
                ->fit(400, 150)
                ->encode('webp', 90)
                ->save(storage_path('/app/public/collections/articles/'. $image_name_min));

            $moviesArr[] = $article['article_movie'];

            Article::create([
                'collection_id' => $collection->id,
                'title' => $article['article_title'],
                'description' => $article['article_description'],
                'image' => $image_name,
                'image_min' => $image_name_min,
                'movie_id' => $article['article_movie']
            ]);

        };

        $moviesArr = array_filter($moviesArr);

        $collection->movies()->attach($moviesArr);

    }

}

<?php

namespace App\Services\Back\Collections;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

Class UpdateService
{
    public function update($data, $collection)
    {
        if (gettype($data['poster']) === 'object') {
            File::delete(storage_path('/app/public/movies' . $collection->poster));
            File::delete(storage_path('app/public/collections/posters/' . $collection->poster));
            $image_name = Carbon::now()->getTimestampMs() . '.' . 'webp';
            Image::make($data['poster'])
                ->fit(135, 200)
                ->encode('webp', 90)
                ->save(storage_path('/app/public/collections/posters/' . $image_name));
            $data['poster'] = $image_name;
        } else {
            $image_name = explode('/', $data['poster']);
            $last_name = array_pop($image_name);
            $data['poster'] = $last_name;
        }

        $articleTitlesArr = [];
        $articleMoviesArr = [];

        foreach($data['articles'] as $key => $article)
        {
            $articleTitlesArr[] = $article['article_title'];
            $articleMoviesArr[] = $article['article_movie'];
        }

        $deletedArticles = Article::where('collection_id', $data['collection_id'])
            ->whereNotIn('title', $articleTitlesArr)
            ->get()
            ->toArray();


        foreach ($deletedArticles as $deleteArticle)
        {
            File::delete(storage_path('/app/public/collections/articles/' . $deleteArticle['image']));
            $article = Article::where('id', $deleteArticle['id']);
            $article->delete();
        }

        foreach($data['articles'] as $key => $article)
        {
            $articleInstance = Article::where('title', $article['article_title'])->first();

            if (gettype($article['article_image']) === 'object') {
                if($articleInstance != null) {
                    File::delete(storage_path('app/public/collections/articles/' . $articleInstance->image));
                    File::delete(storage_path('app/public/collections/articles/' . $articleInstance->image_min));
                }
                $image_name = Carbon::now()->getTimestampMs() . '.webp';
                $image_name_min = 'min_' . Carbon::now()->getTimestampMs() . '.webp';
                Image::make($article['article_image'])
                    ->fit(1200, 450)
                    ->encode('webp', 90)
                    ->save(storage_path('/app/public/collections/articles/' . $image_name));

                Image::make($article['article_image'])
                    ->fit(400, 150)
                    ->encode('webp', 90)
                    ->save(storage_path('/app/public/collections/articles/' . $image_name_min));

                $article['article_image'] = $image_name;
                $article['article_image_min'] = $image_name_min;
            } else {
                $image_name = explode('/', $article['article_image']);
                $last_name = array_pop($image_name);
                $article['article_image'] = $last_name;
                $article['article_image_min'] = 'min_' . $last_name;
            }


            Article::UpdateOrCreate([
                'title' => $article['article_title'],
            ],[
                'collection_id' => $collection->id,
                'title' => $article['article_title'],
                'description' => $article['article_description'],
                'image' => $article['article_image'],
                'image_min' => $article['article_image_min'],
                'movie_id' => $article['article_movie'],
            ]);

        }

        $collection->update([
            'is_published' => $data['is_published'],
            'collection_title' => $data['collection_title'],
            'slug' => $data['slug'],
            'description_min' => $data['description_min'],
            'description' => $data['description'],
            'poster' => $data['poster'],
            'meta_title' => $data['meta_title'],
            'meta_keywords' => $data['meta_keywords'],
            'meta_description' => $data['meta_description']
        ]);

        $collection->movies()->sync($articleMoviesArr);
    }

}

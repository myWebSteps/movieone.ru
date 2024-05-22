<?php

namespace App\Services\Front\Movies;

use Illuminate\Support\Facades\Cache;

class FilterService
{
         public function alignData($data)
        {
            if(!isset($data['category']))
            {
                abort(404);
            };
            if(!isset($data['type']))
            {
                $data['type'] = null;
            };
            if(!isset($data['genre']))
            {
                $data['genre'] = null;
            };
            if(!isset($data['country']))
            {
                $data['country'] = null;
            };
            if(!isset($data['page']))
            {
                $data['page'] = 1;
            };
            if(!isset($data['genres_filter']))
            {
                $data['genres_filter'] = null;
            };

            return $data;
        }

        public function alignDataWithYear($data, $originalYearFrom, $originalYearTo)
        {
            if(!isset($data['yearFrom']))
            {
                $data['yearFrom'] = $originalYearFrom;
            };
            if(!isset($data['yearTo']))
            {
                $data['yearTo'] = $originalYearTo;
            };
            if((isset($data['yearFrom']) && isset($data['yearTo'])) && $data['yearTo'] < $data['yearFrom'])
            {
                $data['yearFrom'] = $originalYearFrom;
                $data['yearTo'] = $originalYearTo;
            }
        return $data;
        }

        public function typesCount($category){
            $typesCount = [];

            $typesCount['feature'] = Cache::get("movies")->where('category_id', $category->id)->where('type', 2)->count();
            $typesCount['serial'] = Cache::get("movies")->where('category_id', $category->id)->where('type', 3)->count();
            $typesCount['mini_serial'] = Cache::get("movies")->where('category_id', $category->id)->where('type', 4)->count();

            return $typesCount;
        }

        public function countries($countries_result, $category)
        {
            $countries = [];
            foreach ($countries_result as $item)
            {
                $countriesItem = [];
                $countriesItem['id'] = $item->id;
                $countriesItem['title'] = $item->title;
                $countriesItem['slug'] = $item->slug;
                $countriesItem['count'] = $item->movies->where('category_id', $category->id)->count();
                $countries[] = $countriesItem;
            }
            return $countries;
        }
}


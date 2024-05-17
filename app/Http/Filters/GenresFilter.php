<?php


namespace App\Http\Filters;


use App\Models\Category;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class GenresFilter extends AbstractFilter
{
    const GENRES_FILTER = 'genres_filter';


    protected function getCallbacks(): array
    {
        return [
            self::GENRES_FILTER => [$this, 'genresFilter'],
        ];
    }

    protected function genresFilter(Builder $builder, $value)
    {
        $category = Cache::get("genres")->where('category_id', $this->getQueryParam('category_id'))->first();

        $builder->where('category_id', $category->id)
        ->where('title', 'like', "%$value%")
        ->orWhere('slug', 'like', "%$value%");
    }


}

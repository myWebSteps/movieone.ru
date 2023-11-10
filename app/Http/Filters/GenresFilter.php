<?php


namespace App\Http\Filters;


use App\Models\Category;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Builder;

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

        $category = Category::where('slug', $this->getQueryParam('category'))->first();

        $builder->where('category_id', $category->id)
        ->where('title', 'like', "%$value%")
        ->orWhere('slug', 'like', "%$value%");
    }


}

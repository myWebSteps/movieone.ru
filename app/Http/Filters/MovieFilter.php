<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class MovieFilter extends AbstractFilter
{
    const CATEGORY = 'category';
    const GENRE = 'genre';
    const TYPE = 'type';
    const SEARCH = 'key';



    protected function getCallbacks(): array
    {
        return [
            self::CATEGORY => [$this, 'category'],
            self::GENRE => [$this, 'genre'],
            self::TYPE => [$this, 'type'],
            self::SEARCH => [$this, 'search']

        ];
    }

    protected function category(Builder $builder, $value)
    {
        $builder->where('category_id', (int)$value);
    }

    protected function type(Builder $builder, $value)
    {
        $builder->where('type', (int)$value);
    }

    protected function search(Builder $builder, $value)
    {
        $builder->where('nameRu', 'like', "%$value%")
        ->orWhere('nameEn', 'like', "%$value%")
        ->orWhere('description', 'like', "%$value%");
    }

    protected function genre(Builder $builder, $value)
    {
        $builder->whereHas('genres', function ($b) use($value){
            $b->where('genre_id', (int)$value);
        });
    }
}

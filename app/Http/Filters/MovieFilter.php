<?php


namespace App\Http\Filters;


use App\Models\Category;
use App\Models\Genre;
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
            self::SEARCH => [$this, 'search'],
        ];
    }

    protected function category(Builder $builder, $value)
    {

        $cat = Category::where('slug', $value)->first();

        $builder->where('category_id', $cat->id);
    }

    protected function type(Builder $builder, $value)
    {
        if($value === 'feature')
        {
            $type = 2;
        }else if($value === 'serial')
        {
            $type = 3;
        }else if($value === 'mini_serial')
        {
            $type = 4;
        }else
        {
        abort(404);
        }

        $builder->where('type', $type);
    }

    protected function search(Builder $builder, $value)
    {
        $builder->where('nameRu', 'like', "%$value%")
        ->orWhere('nameEn', 'like', "%$value%");
    }

    protected function genre(Builder $builder, $value)
    {
        $builder->whereHas('genres', function ($b) use($value){
            $cat = Category::where('slug', $this->getQueryParam('category'))->first();
            $genre = Genre::where('category_id', $cat->id)->where('slug', $value)->first();

            $b->where('genre_id', $genre->id);

        });
    }

}

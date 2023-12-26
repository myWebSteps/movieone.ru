<?php


namespace App\Http\Filters;


use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Builder;

class CountriesFilter extends AbstractFilter
{
    const COUNTRIES_FILTER = 'countries_filter';


    protected function getCallbacks(): array
    {
        return [
            self::COUNTRIES_FILTER => [$this, 'countriesFilter'],
        ];
    }

    protected function countriesFilter(Builder $builder, $value)
    {

        $builder->where('title', 'like', "%$value%")
        ->orWhere('slug', 'like', "%$value%");
    }


}

<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use Filterable;
    use Sluggable;

    protected $table = 'movies';
    protected $guarded = false;


    public function genres()
    {
        return $this->belongsToMany( Genre::class, GenreMovie::class, 'movie_id', 'genre_id');
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class, CountryMovie::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nameRu'
            ]
        ];
    }
}

<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use Filterable;

    protected $table = 'genres';
    protected $guarded = false;
    public $timestamps = false;

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'genre_movies');
    }
}

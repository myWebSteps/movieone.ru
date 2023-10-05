<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genres';
    protected $guarded = false;
    public $timestamps = false;

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'genre_movies');
    }
}

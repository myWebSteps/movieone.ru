<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenreMovie extends Model
{
    protected $table = 'genre_movies';
    protected $guarded = false;
    public $timestamps = false;
}

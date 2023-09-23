<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryMovie extends Model
{
    protected $table='country_movies';
    protected $guarded = false;
    public $timestamps = false;
}

<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table='countries';
    protected $guarded = false;
    public $timestamps = false;

    use Filterable;

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'country_movies');
    }
}

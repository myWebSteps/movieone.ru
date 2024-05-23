<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactMovie extends Model
{
    protected $table='fact_movies';
    protected $guarded = false;
    public $timestamps = false;

    protected $casts = [
        'spoiler' => 'boolean',
    ];


}

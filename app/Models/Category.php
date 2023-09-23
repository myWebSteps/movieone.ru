<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table='categories';
    protected $guarded = false;
    public $timestamps = false;

    public function genres()
    {
        return $this->hasMany(Genre::class);
    }

    public function movies()
    {
        return $this->hasMany(Movie::class);
    }

}

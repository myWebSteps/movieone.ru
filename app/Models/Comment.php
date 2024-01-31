<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='comments';
    protected $guarded = false;

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id', 'id');
    }

}

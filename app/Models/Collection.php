<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use Sluggable;

    protected $table = 'collections';
    protected $guarded = false;


    public function articles()
    {
     return $this->hasMany(Article::class, 'collection_id', 'id');
    }

    public function movies()
    {
        return $this->hasManyThrough(Movie::class, Article::class);
    }

    public function comments()
    {
        return $this->hasMany(CollectionComment::class);
    }


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'collection_title'
            ]
        ];
    }
}

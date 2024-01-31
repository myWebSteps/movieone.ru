<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionComment extends Model
{
    protected $table = 'collection_comments';
    protected $guarded = false;

    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id', 'id');
    }
}

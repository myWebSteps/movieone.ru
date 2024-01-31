<?php

namespace App\Http\Controllers\Back\Admin\Comments\Collections;

use App\Http\Controllers\Controller;
use App\Models\CollectionComment;


class DestroyController extends Controller
{
    public function __invoke(CollectionComment $comment)
    {
       $comment->delete();

       return to_route('collection.comments.index');
    }
}

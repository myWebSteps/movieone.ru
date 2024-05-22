<?php

namespace App\Http\Controllers\Back\Admin\Comments\Movies;

use App\Http\Controllers\BaseControllers\Back\Comments\MoviesController;
use App\Models\Comment;

class DestroyController extends MoviesController
{
    public function __invoke(Comment $comment)
    {
        $comment->delete();

        $this->destroyService->recount($comment);

        $this->cacheService->resetCache();

       return to_route('comments.index');
    }
}

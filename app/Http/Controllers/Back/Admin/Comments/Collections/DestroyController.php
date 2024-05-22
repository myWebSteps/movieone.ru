<?php

namespace App\Http\Controllers\Back\Admin\Comments\Collections;

use App\Http\Controllers\BaseControllers\Back\Comments\CollectionsController;
use App\Models\CollectionComment;


class DestroyController extends CollectionsController
{
    public function __invoke(CollectionComment $comment)
    {
       $comment->delete();

        $this->destroyService->recount($comment);

        $this->cacheService->resetCache();

       return to_route('collection.comments.index');
    }
}

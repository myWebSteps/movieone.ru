<?php

namespace App\Http\Controllers\Back\Admin\Comments\Collections;

use App\Http\Controllers\BaseControllers\Back\Comments\CollectionsController;
use App\Http\Requests\Back\Admin\Comments\Collections\UpdateRequest;
use App\Models\CollectionComment;


class UpdateController extends CollectionsController
{
    public function __invoke(UpdateRequest $request, CollectionComment $comment)
    {
       $data = $request->validated();

       $this->updateService->recount($comment, $data);

       $this->cacheService->resetCache();

       return to_route('collection.comments.index');
    }
}

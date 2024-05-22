<?php

namespace App\Http\Controllers\Back\Admin\Comments\Movies;

use App\Http\Controllers\BaseControllers\Back\Comments\MoviesController;
use App\Http\Requests\Back\Admin\Comments\Movies\UpdateRequest;
use App\Models\Comment;

class UpdateController extends MoviesController
{
    public function __invoke(UpdateRequest $request, Comment $comment)
    {
        $data = $request->validated();
        $comment->update($data);

        $this->updateService->recount($comment, $data);

        $this->cacheService->resetCache();

       return to_route('comments.index');
    }
}

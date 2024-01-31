<?php

namespace App\Http\Controllers\Back\Admin\Comments\Collections;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Admin\Comments\Collections\UpdateRequest;
use App\Models\Category;
use App\Models\CollectionComment;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, CollectionComment $comment)
    {
       $data = $request->validated();
       $comment->update($data);

       return to_route('collection.comments.index');
    }
}

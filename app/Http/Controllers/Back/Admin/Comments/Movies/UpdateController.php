<?php

namespace App\Http\Controllers\Back\Admin\Comments\Movies;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Admin\Comments\Movies\UpdateRequest;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Comment $comment)
    {

       $data = $request->validated();
       $comment->update($data);

       return to_route('comments.index');
    }
}

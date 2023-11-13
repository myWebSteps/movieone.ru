<?php

namespace App\Http\Controllers\Back\Admin\Comments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Admin\Categories\UpdateRequest;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class DestroyController extends Controller
{
    public function __invoke(Comment $comment)
    {
       $comment->delete();

       return to_route('comments.index');
    }
}

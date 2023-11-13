<?php

namespace App\Http\Controllers\Back\Admin\Comments;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class EditController extends Controller
{
    public function __invoke(Comment $comment)
    {

       return Inertia::render('Back/Admin/Comments/Edit', compact('comment'));
    }
}

<?php

namespace App\Http\Controllers\Back\Admin\Comments\Movies;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Inertia\Inertia;

class EditController extends Controller
{
    public function __invoke(Comment $comment)
    {

       return Inertia::render('Back/Admin/Comments/Movies/Edit', compact('comment'));
    }
}

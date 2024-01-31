<?php

namespace App\Http\Controllers\Back\Admin\Comments\Collections;

use App\Http\Controllers\Controller;
use App\Models\CollectionComment;
use Inertia\Inertia;

class EditController extends Controller
{
    public function __invoke(CollectionComment $comment)
    {
       return Inertia::render('Back/Admin/Comments/Collections/Edit', compact('comment'));
    }
}

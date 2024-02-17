<?php

namespace App\Http\Controllers\Info;

use App\Http\Controllers\Controller;
use App\Models\CollectionComment;
use App\Models\Comment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommentsCountController extends Controller
{
    public function __invoke()
    {
        $comments = [];

        $comments['movies'] = Comment::where('approved', 0)->count();
        $comments['collections'] = CollectionComment::where('approved', 0)->count();
        $comments['total'] = $comments['movies'] + $comments['collections'];

        return $comments;
    }
}

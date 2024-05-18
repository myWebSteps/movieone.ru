<?php

namespace App\Http\Controllers\Back\Admin\Comments\Movies;

use App\Http\Controllers\Controller;
use App\Http\Resources\Back\Admin\Comments\Movies\IndexResource;
use App\Models\Comment;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke()
    {
       $result = Comment::orderBy('id', 'DESC')->get();

       $data_comments = IndexResource::collection($result)->resolve();

       return Inertia::render('Back/Admin/Comments/Movies/Index', compact('data_comments'));
    }
}

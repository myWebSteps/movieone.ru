<?php

namespace App\Http\Controllers\Back\Admin\Comments;

use App\Http\Controllers\Controller;
use App\Http\Resources\Back\Admin\Comments\IndexResource;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke()
    {
       $result = Comment::all();

       $data_comments = IndexResource::collection($result)->resolve();

       return Inertia::render('Back/Admin/Comments/Index', compact('data_comments'));
    }
}

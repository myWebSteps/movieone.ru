<?php

namespace App\Http\Controllers\Back\Admin\Comments\Collections;

use App\Http\Controllers\Controller;
use App\Http\Resources\Back\Admin\Comments\Collections\IndexResource;
use App\Models\CollectionComment;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke()
    {
       $result = CollectionComment::orderBy('id', 'DESC')->get();

       $data_comments = IndexResource::collection($result)->resolve();

       return Inertia::render('Back/Admin/Comments/Collections/Index', compact('data_comments'));
    }
}

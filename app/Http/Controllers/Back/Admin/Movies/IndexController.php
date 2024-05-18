<?php

namespace App\Http\Controllers\Back\Admin\Movies;

use App\Http\Controllers\Controller;

use App\Http\Resources\Back\Admin\Movies\IndexResource;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;


class IndexController extends Controller
{
    public function __invoke()
    {
       $result = DB::table('movies')->orderBy('id', 'desc')->get();

       $data = IndexResource::collection($result)->resolve();

       return Inertia::render('Back/Admin/Movies/Index', compact('data'));
    }
}

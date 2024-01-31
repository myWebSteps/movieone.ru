<?php

namespace App\Http\Controllers\Back\Admin\Collections;

use App\Http\Controllers\Controller;

use App\Http\Resources\Back\Admin\Collections\IndexResource;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;



class IndexController extends Controller
{
    public function __invoke()
    {
       $result = DB::table('collections')->orderBy('id', 'desc')->get();

       $data = IndexResource::collection($result)->resolve();

       return Inertia::render('Back/Admin/Collections/Index', compact('data'));
    }
}

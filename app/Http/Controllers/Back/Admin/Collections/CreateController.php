<?php

namespace App\Http\Controllers\Back\Admin\Collections;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CreateController extends Controller
{
    public function __invoke(Request $request)
    {
        $movies = DB::table('movies')->select('id', 'nameRu', 'nameEn', 'year')->orderBy('id', 'desc')->get();

        return Inertia::render('Back/Admin/Collections/Create', compact('movies'));
    }
}

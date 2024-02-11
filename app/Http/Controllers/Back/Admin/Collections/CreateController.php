<?php

namespace App\Http\Controllers\Back\Admin\Collections;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CreateController extends Controller
{
    public function __invoke(Request $request)
    {
        $movies = Movie::all('id', 'nameRu', 'nameEn', 'year');

        return Inertia::render('Back/Admin/Collections/Create', compact('movies'));
    }
}

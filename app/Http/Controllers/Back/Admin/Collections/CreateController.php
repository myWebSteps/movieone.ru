<?php

namespace App\Http\Controllers\Back\Admin\Collections;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Title;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class CreateController extends Controller
{
    public function __invoke()
    {
        $movies = Movie::all('id', 'nameRu', 'nameEn', 'year');

       return Inertia::render('Back/Admin/Collections/Create', compact('movies'));
    }
}

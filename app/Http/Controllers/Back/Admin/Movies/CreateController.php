<?php

namespace App\Http\Controllers\Back\Admin\Movies;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use App\Models\Title;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class CreateController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();
        $countries = Country::all();
        $titles = Title::all();
       return Inertia::render('Back/Admin/Movies/Create', compact('categories', 'countries', 'titles'));
    }
}

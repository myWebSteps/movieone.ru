<?php

namespace App\Http\Controllers\Back\Admin\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use Inertia\Inertia;

class CreateController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();
        $countries = Country::all();
       return Inertia::render('Back/Admin/Categories/Create', compact('categories', 'countries'));
    }
}

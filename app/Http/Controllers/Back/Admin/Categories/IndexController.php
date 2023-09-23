<?php

namespace App\Http\Controllers\Back\Admin\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke()
    {
       $categories = Category::all();

       return Inertia::render('Back/Admin/Categories/Index', compact('categories'));
    }
}

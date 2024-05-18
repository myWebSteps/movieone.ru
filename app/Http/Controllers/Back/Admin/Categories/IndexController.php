<?php

namespace App\Http\Controllers\Back\Admin\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke()
    {
       $categories = Category::all();

       return Inertia::render('Back/Admin/Categories/Index', compact('categories'));
    }
}

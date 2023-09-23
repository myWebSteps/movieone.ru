<?php

namespace App\Http\Controllers\Back\Admin\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class EditController extends Controller
{
    public function __invoke(Category $category)
    {
       return Inertia::render('Back/Admin/Categories/Edit', compact('category'));
    }
}

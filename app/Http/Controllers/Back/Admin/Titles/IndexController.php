<?php

namespace App\Http\Controllers\Back\Admin\Titles;

use App\Http\Controllers\Controller;
use App\Http\Resources\Back\Admin\Genres\IndexResource;
use App\Models\Category;
use App\Models\Title;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke()
    {
       $data = Title::all();

       return Inertia::render('Back/Admin/Titles/Index', compact('data'));
    }
}

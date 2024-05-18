<?php

namespace App\Http\Controllers\Back\Admin\Titles;

use App\Http\Controllers\Controller;
use App\Models\Title;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke()
    {
       $data = Title::all();

       return Inertia::render('Back/Admin/Titles/Index', compact('data'));
    }
}

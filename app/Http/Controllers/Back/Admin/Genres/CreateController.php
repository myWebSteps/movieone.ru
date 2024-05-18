<?php

namespace App\Http\Controllers\Back\Admin\Genres;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CreateController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->category;

       return Inertia::render('Back/Admin/Genres/Create', compact('data'));
    }
}

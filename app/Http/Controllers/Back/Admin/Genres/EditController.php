<?php

namespace App\Http\Controllers\Back\Admin\Genres;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class EditController extends Controller
{
    public function __invoke(Genre $genre)
    {
        return Inertia::render('Back/Admin/Genres/Edit', compact('genre'));
    }
}

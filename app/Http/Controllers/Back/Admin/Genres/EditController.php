<?php

namespace App\Http\Controllers\Back\Admin\Genres;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Inertia\Inertia;

class EditController extends Controller
{
    public function __invoke(Genre $genre)
    {
        return Inertia::render('Back/Admin/Genres/Edit', compact('genre'));
    }
}

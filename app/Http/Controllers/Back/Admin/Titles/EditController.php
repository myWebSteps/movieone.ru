<?php

namespace App\Http\Controllers\Back\Admin\Titles;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Title;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class EditController extends Controller
{
    public function __invoke(Title $title)
    {
        return Inertia::render('Back/Admin/Titles/Edit', compact('title'));
    }
}

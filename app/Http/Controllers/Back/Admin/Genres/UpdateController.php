<?php

namespace App\Http\Controllers\Back\Admin\Genres;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Admin\Genres\UpdateRequest;
use App\Models\Category;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Genre $genre)
    {
       $data = $request->validated();
       $genre->update($data);
       return to_route('genres.index');
    }
}

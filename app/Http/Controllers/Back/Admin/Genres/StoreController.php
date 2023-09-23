<?php

namespace App\Http\Controllers\Back\Admin\Genres;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Admin\Genres\StoreRequest;
use App\Models\Category;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        Genre::create($data);

       return to_route('genres.index');
    }
}

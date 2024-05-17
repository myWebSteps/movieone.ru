<?php

namespace App\Http\Controllers\Back\Admin\Genres;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Admin\Categories\UpdateRequest;
use App\Models\Category;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class DestroyController extends BaseController
{
    public function __invoke(Genre $genre)
    {
       $genre->delete();

       $this->service->resetCache();

       return to_route('genres.index');
    }
}

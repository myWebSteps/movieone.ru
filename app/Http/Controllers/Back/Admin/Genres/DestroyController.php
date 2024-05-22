<?php

namespace App\Http\Controllers\Back\Admin\Genres;

use App\Http\Controllers\BaseControllers\BaseController;
use App\Models\Genre;

class DestroyController extends BaseController
{
    public function __invoke(Genre $genre)
    {
       $genre->delete();

       $this->cacheService->resetCache();

       return to_route('genres.index');
    }
}

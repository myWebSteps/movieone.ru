<?php

namespace App\Http\Controllers\Back\Admin\Movies;

use App\Http\Controllers\BaseController;
use App\Models\Movie;
use Illuminate\Support\Facades\File;

class DestroyController extends BaseController
{
    public function __invoke(Movie $movie)
    {
        File::delete(storage_path('/app/public/movies' . $movie->backdrop));
        File::delete(storage_path('/app/public/movies' . $movie->backdrop_min));
        File::delete(storage_path('/app/public/movies' . $movie->poster));

        $movie->delete();

        $this->service->resetCache();

    }
}

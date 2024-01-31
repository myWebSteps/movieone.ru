<?php

namespace App\Http\Controllers\Back\Admin\Movies;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Support\Facades\File;

class DestroyController extends Controller
{
    public function __invoke(Movie $movie)
    {

        $fileToDelete = $movie->getAttribute('poster');

        File::delete(storage_path('/app/public/movies' . $fileToDelete));

        $movie->delete();
    }
}

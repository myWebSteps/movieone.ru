<?php

namespace App\Http\Controllers\Back\Admin\Movies;

use App\Http\Controllers\BaseControllers\Back\MoviesController;
use App\Models\Movie;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DestroyController extends MoviesController
{
    public function __invoke(Movie $movie)
    {
        File::delete(storage_path('/app/public/movies' . $movie->backdrop));
        File::delete(storage_path('/app/public/movies' . $movie->backdrop_min));
        File::delete(storage_path('/app/public/movies' . $movie->poster));

        $del = $movie->soundTracks;
        foreach ($del as $item) {
            File::delete(storage_path('/app/public/movies/soundtracks/' . $movie->id. '/'. $item->file));
        }

        //Удаляем пустую папку
        $FileSystem = new Filesystem();
        $directory = storage_path('app/public/movies/soundtracks/'.$movie->id);

        if ($FileSystem->exists($directory)) {
            $files = $FileSystem->files($directory);
            if (empty($files)) {
                // Yes, delete the directory.
                $FileSystem->deleteDirectory($directory);
            }
        }

        $movie->delete();

        $this->cacheService->resetCache();

    }
}

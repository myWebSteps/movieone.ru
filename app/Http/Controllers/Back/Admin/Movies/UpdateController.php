<?php

namespace App\Http\Controllers\Back\Admin\Movies;

use App\Http\Controllers\BaseControllers\Back\MoviesController;
use App\Http\Requests\Back\Admin\Movies\UpdateRequest;
use App\Models\Movie;


class UpdateController extends MoviesController
{
    public function __invoke(UpdateRequest $request, Movie $movie)
    {
        $data = $request->validated();

        $this->updateService->update($data, $movie);

        $this->cacheService->resetCache();

        return to_route('movies.index');
    }
}

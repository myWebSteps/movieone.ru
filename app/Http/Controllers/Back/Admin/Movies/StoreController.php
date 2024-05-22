<?php

namespace App\Http\Controllers\Back\Admin\Movies;
use App\Http\Controllers\BaseControllers\Back\MoviesController;
use App\Http\Requests\Back\Admin\Movies\StoreRequest;

class StoreController extends MoviesController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $this->storeService->store($data);

        $this->cacheService->resetCache();

        return to_route('movies.index');
    }
}

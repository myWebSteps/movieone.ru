<?php

namespace App\Http\Controllers\Back\Admin\Genres;

use App\Http\Controllers\BaseControllers\BaseController;
use App\Http\Requests\Back\Admin\Genres\StoreRequest;
use App\Models\Genre;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        Genre::create($data);

        $this->cacheService->resetCache();

       return to_route('genres.index');
    }
}

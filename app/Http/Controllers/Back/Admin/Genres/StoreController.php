<?php

namespace App\Http\Controllers\Back\Admin\Genres;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Back\Admin\Genres\StoreRequest;
use App\Models\Genre;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        Genre::create($data);

        $this->service->resetCache();

       return to_route('genres.index');
    }
}

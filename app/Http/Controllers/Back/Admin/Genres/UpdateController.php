<?php

namespace App\Http\Controllers\Back\Admin\Genres;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Back\Admin\Genres\UpdateRequest;
use App\Models\Genre;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, Genre $genre)
    {
       $data = $request->validated();
       $genre->update($data);

       $this->service->resetCache();

       return to_route('genres.index');
    }
}

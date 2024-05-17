<?php

namespace App\Http\Controllers\Back\Admin\Titles;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Admin\Titles\StoreRequest;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Title;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        Title::create($data);

        $this->service->resetCache();

       return to_route('titles.index');
    }
}

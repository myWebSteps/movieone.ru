<?php

namespace App\Http\Controllers\Back\Admin\Titles;

use App\Http\Controllers\BaseControllers\BaseController;
use App\Http\Requests\Back\Admin\Titles\StoreRequest;
use App\Models\Title;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        Title::create($data);

        $this->cacheService->resetCache();

       return to_route('titles.index');
    }
}

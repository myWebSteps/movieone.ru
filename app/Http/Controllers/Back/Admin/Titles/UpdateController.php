<?php

namespace App\Http\Controllers\Back\Admin\Titles;

use App\Http\Controllers\BaseControllers\BaseController;
use App\Http\Requests\Back\Admin\Titles\UpdateRequest;
use App\Models\Title;


class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, Title $title)
    {
       $data = $request->validated();
       $title->update($data);

       $this->cacheService->resetCache();

       return to_route('titles.index');
    }
}

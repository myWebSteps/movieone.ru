<?php

namespace App\Http\Controllers\Back\Admin\Collections;

use App\Http\Controllers\BaseControllers\Back\CollectionsController;
use App\Http\Requests\Back\Admin\Collections\StoreRequest;


class StoreController extends CollectionsController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $this->storeService->store($data);

        $this->cacheService->resetCache();

        return to_route('collections.index');
    }
}

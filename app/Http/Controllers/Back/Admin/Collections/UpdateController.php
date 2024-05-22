<?php

namespace App\Http\Controllers\Back\Admin\Collections;

use App\Http\Controllers\BaseControllers\Back\CollectionsController;
use App\Http\Requests\Back\Admin\Collections\UpdateRequest;
use App\Models\Collection;


class UpdateController extends CollectionsController
{
    public function __invoke(UpdateRequest $request, Collection $collection)
    {
        $data = $request->validated();

        $this->updateService->update($data, $collection);

        $this->cacheService->resetCache();

        return to_route('collections.index');
    }
}

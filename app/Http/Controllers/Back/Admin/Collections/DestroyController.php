<?php

namespace App\Http\Controllers\Back\Admin\Collections;

use App\Http\Controllers\BaseControllers\Back\CollectionsController;
use App\Models\Collection;
use function Symfony\Component\ErrorHandler\ErrorRenderer\addElementToGhost;

class DestroyController extends CollectionsController
{
    public function __invoke(Collection $collection)
    {
       $this->destroyService->destroy($collection);

       $this->cacheService->resetCache();
    }
}

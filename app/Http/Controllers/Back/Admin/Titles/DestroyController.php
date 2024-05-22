<?php

namespace App\Http\Controllers\Back\Admin\Titles;

use App\Http\Controllers\BaseControllers\BaseController;
use App\Models\Title;

class DestroyController extends BaseController
{
    public function __invoke(Title $title)
    {
        $title->delete();

        $this->cacheService->resetCache();

       return to_route('titles.index');
    }
}

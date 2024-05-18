<?php

namespace App\Http\Controllers\Back\Admin\Titles;

use App\Http\Controllers\BaseController;
use App\Models\Title;

class DestroyController extends BaseController
{
    public function __invoke(Title $title)
    {
        $title->delete();

        $this->service->resetCache();

       return to_route('titles.index');
    }
}

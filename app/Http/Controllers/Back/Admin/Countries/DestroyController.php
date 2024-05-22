<?php

namespace App\Http\Controllers\Back\Admin\Countries;

use App\Http\Controllers\BaseControllers\BaseController;
use App\Models\Country;

class DestroyController extends BaseController
{
    public function __invoke(Country $country)
    {
        $country->delete();

        $this->cacheService->resetCache();

       return to_route('countries.index');
    }
}

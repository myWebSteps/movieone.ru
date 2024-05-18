<?php

namespace App\Http\Controllers\Back\Admin\Countries;

use App\Http\Controllers\BaseController;
use App\Models\Country;

class DestroyController extends BaseController
{
    public function __invoke(Country $country)
    {
        $country->delete();

        $this->service->resetCache();

       return to_route('countries.index');
    }
}

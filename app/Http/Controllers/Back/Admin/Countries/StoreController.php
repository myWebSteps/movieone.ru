<?php

namespace App\Http\Controllers\Back\Admin\Countries;

use App\Http\Controllers\BaseControllers\BaseController;
use App\Http\Requests\Back\Admin\Countries\StoreRequest;
use App\Models\Country;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        Country::firstOrCreate(['title' => $data['title'], 'slug'=>$data['slug']],
        $data
        );

        $this->cacheService->resetCache();

       return to_route('countries.index');
    }
}

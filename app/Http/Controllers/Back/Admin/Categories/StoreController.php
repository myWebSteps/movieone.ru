<?php

namespace App\Http\Controllers\Back\Admin\Categories;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Back\Admin\Categories\StoreRequest;
use App\Models\Category;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        Category::firstOrCreate(['title' => $data['title']],
        $data
        );

        $this->service->resetCache();

       return to_route('categories.index');
    }
}

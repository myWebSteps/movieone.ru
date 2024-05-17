<?php

namespace App\Http\Controllers\Back\Admin\Categories;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Admin\Categories\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, Category $category)
    {
       $data = $request->validated();
       $category->update($data);

       $this->service->resetCache();

       return to_route('categories.index');
    }
}

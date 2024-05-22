<?php

namespace App\Http\Controllers\Back\Admin\Categories;

use App\Http\Controllers\BaseControllers\BaseController;
use App\Models\Category;


class DestroyController extends BaseController
{
    public function __invoke(Category $category)
    {
       $category->delete();

       $this->cacheService->resetCache();

       return to_route('categories.index');
    }
}

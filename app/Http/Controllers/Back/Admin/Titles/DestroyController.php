<?php

namespace App\Http\Controllers\Back\Admin\Titles;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Admin\Categories\UpdateRequest;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Title;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class DestroyController extends BaseController
{
    public function __invoke(Title $title)
    {
        $title->delete();

        $this->service->resetCache();

       return to_route('titles.index');
    }
}

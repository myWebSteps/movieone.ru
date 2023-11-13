<?php

namespace App\Http\Controllers\Back\Admin\Comments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Admin\Categories\StoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        Category::firstOrCreate(['title' => $data['title']],
        $data
        );

       return to_route('categories.index');
    }
}

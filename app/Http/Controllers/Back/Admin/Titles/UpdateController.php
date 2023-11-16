<?php

namespace App\Http\Controllers\Back\Admin\Titles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Admin\Titles\UpdateRequest;
use App\Models\Title;


class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Title $title)
    {
       $data = $request->validated();
       $title->update($data);
       return to_route('titles.index');
    }
}

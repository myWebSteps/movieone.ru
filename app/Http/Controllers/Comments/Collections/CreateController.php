<?php

namespace App\Http\Controllers\Comments\Collections;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comments\CollectionCreateRequest;
use App\Models\CollectionComment;

class CreateController extends Controller
{
    public function __invoke(CollectionCreateRequest $request)
    {
        $data = $request->validated();

        CollectionComment::create($data);

    }
}

<?php

namespace App\Http\Controllers\Comments\Collections;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comments\CollectionCreateRequest;
use App\Models\CollectionComment;
use function Symfony\Component\Routing\Loader\Configurator\collection;

class CreateController extends Controller
{
    public function __invoke(CollectionCreateRequest $request)
    {
        $data = $request->validated();

        CollectionComment::create([
            'collection_id' => $data['id'],
            'name' => $data['name'],
            'rating' => $data['rating'],
            'description' => $data['description']
        ]);

    }
}

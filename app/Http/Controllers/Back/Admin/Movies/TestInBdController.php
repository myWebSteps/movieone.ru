<?php

namespace App\Http\Controllers\Back\Admin\Movies;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Admin\Movies\TestInBdRequest;
use App\Models\Movie;
use Illuminate\Http\Request;

class TestInBdController extends Controller
{
    public function __invoke(TestInBdRequest $request)
    {
        $data = $request->validated();

        return Movie::where('kinopoisk_id', $data['kinopoisk_id'])->get();
    }
}

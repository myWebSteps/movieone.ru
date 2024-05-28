<?php

namespace App\Http\Controllers\Back\Admin\Collections;

use App\Http\Controllers\Controller;
use App\Http\Resources\Back\Admin\Collections\CollectionsIndexResource;
use App\Models\Collection;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;


class EditController extends Controller
{
    public function __invoke(Request $request)
    {

        $collection = Collection::where('id', $request->collection)->get();

        $data = CollectionsIndexResource::collection($collection)->resolve();

        $movies = DB::table('movies')->select('id', 'nameRu', 'nameEn', 'year')->orderBy('id', 'desc')->get();

        return Inertia::render('Back/Admin/Collections/Edit', compact('data', 'movies'));
    }
}

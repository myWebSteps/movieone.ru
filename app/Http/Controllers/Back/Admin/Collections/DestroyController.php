<?php

namespace App\Http\Controllers\Back\Admin\Collections;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Movie;
use Illuminate\Support\Facades\File;
use function Symfony\Component\ErrorHandler\ErrorRenderer\addElementToGhost;

class DestroyController extends Controller
{
    public function __invoke(Collection $collection)
    {
        File::delete(storage_path('/app/public/collections/posters/' . $collection->poster));

        foreach ($collection->articles as $article)
        {
            File::delete(storage_path('/app/public/collections/articles/' . $article->image));
        }

        $collection->delete();
    }
}

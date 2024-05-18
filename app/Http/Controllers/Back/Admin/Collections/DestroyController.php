<?php

namespace App\Http\Controllers\Back\Admin\Collections;

use App\Http\Controllers\BaseController;
use App\Models\Collection;
use Illuminate\Support\Facades\File;
use function Symfony\Component\ErrorHandler\ErrorRenderer\addElementToGhost;

class DestroyController extends BaseController
{
    public function __invoke(Collection $collection)
    {
        File::delete(storage_path('/app/public/collections/posters/' . $collection->poster));

        foreach ($collection->articles as $article)
        {
            File::delete(storage_path('/app/public/collections/articles/' . $article->image));
        }

        $collection->delete();

        $this->service->resetCache();
    }
}

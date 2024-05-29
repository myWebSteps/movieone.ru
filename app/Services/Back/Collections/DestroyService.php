<?php

namespace App\Services\Back\Collections;

use Illuminate\Support\Facades\File;

Class DestroyService
{
    public function destroy($collection)
    {
        File::delete(storage_path('/app/public/collections/posters/' . $collection->poster));

        foreach ($collection->articles as $article)
        {
            File::delete(storage_path('/app/public/collections/articles/' . $article->image));
            File::delete(storage_path('/app/public/collections/articles/' . $article->image_min));
        }

        $collection->delete();
    }

}

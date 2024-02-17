<?php

namespace App\Http\Controllers\Back\Admin\Comments\Collections;

use App\Http\Controllers\Controller;
use App\Models\CollectionComment;


class DestroyController extends Controller
{
    public function __invoke(CollectionComment $comment)
    {
       $comment->delete();

        $comments = CollectionComment::where('approved', 1)
            ->where('collection_id', $comment['collection_id'])
            ->select('rating')
            ->get()
            ->toArray();


        $rating = 0;

        foreach ($comments as $item) {
            $rating += $item['rating'];
        }

        if(count($comments) > 0)
        {
            $rating = round(($rating / count($comments)), 1);
        }else
        {
            $rating = 0;
        }


        $comment->collection()->update([
            'rating' => $rating,
        ]);


       return to_route('collection.comments.index');
    }
}

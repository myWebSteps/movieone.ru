<?php

namespace App\Services\Back\Comments\Collections;

use App\Models\CollectionComment;

class DestroyService
{
    public function recount($comment)
    {
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
    }
}

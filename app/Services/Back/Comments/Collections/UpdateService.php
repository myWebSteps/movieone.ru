<?php

namespace App\Services\Back\Comments\Collections;

use App\Models\CollectionComment;

class UpdateService
{
    public function recount($comment, $data)
    {
        $comment->update($data);

        $comments = CollectionComment::where('approved', 1)
            ->where('collection_id', $data['collection_id'])
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

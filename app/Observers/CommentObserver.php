<?php

namespace App\Observers;

use App\Comment;
use Illuminate\Support\Facades\Cache;

class CommentObserver
{
    /**
     * Handle the comment "created" event.
     *
     * @param  \App\Comment  $comment
     * @return void
     */
    public function creating(Comment $comment)
    {
        Cache::forget("post-show-{$comment->commentable->id}");
    }

}

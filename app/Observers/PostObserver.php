<?php

namespace App\Observers;

use App\Post;
use Illuminate\Support\Facades\Cache;

class PostObserver
{

    /**
     * Handle the post "updated" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function updating(Post $post)
    {
        Cache::forget("post-show-{$post->id}");
    }

    /**
     * Handle the post "deleted" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function deleting(Post $post)
    {
        $post->comments()->delete();
    }

    /**
     * Handle the post "restored" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function restoring(Post $post)
    {
        $post->comments()->restore();
    }

  
}

<?php

namespace App\Providers;

use App\Comment;
use App\Http\ViewComposers\ActivityComposer;
use App\Observers\CommentObserver;
use App\Observers\PostObserver;
use App\Post;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      view()->composer('*', ActivityComposer::class);

      Post::observe(PostObserver::class);
      Comment::observe(CommentObserver::class);
    }
}

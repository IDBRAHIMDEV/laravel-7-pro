<?php

namespace App\Http\ViewComposers;

use App\Post;
use App\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ActivityComposer {

    public function compose(View $view) {


        $mostCommented = Cache::remember('mostCommented', now()->addMinutes(10), function() {
            return Post::mostCommented()->take(5)->get();
        });

        $mostUsersActive = Cache::remember('mostUsersActive', now()->addMinutes(10), function() {
            return User::usersActive()->take(5)->get();
        });

        $mostUserActiveInLastMonth = Cache::remember('mostUserActiveInLastMonth', now()->addMinutes(10), function() {
            return User::userActiveInLastMonth()->take(5)->get();
        });


        $view->with([
            'mostCommented' => $mostCommented,
            'mostUsersActive' => $mostUsersActive,
            'mostUserActiveInLastMonth' => $mostUserActiveInLastMonth
        ]);

    }
}
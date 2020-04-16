<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = App\Post::all();

        $users = App\User::all();

        if($posts->count() == 0) {
            $this->command->info("please create some posts !");
            return;
        }
        
        $nbComments = (int)$this->command->ask("How many of comment you want generate ?", 100);

        factory(App\Comment::class, $nbComments)->make()->each(function($comment) use ($posts, $users) {
            $comment->post_id = $posts->random()->id;
            $comment->user_id = $users->random()->id;
            $comment->save();
        });
    }
}

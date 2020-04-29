<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $users = App\User::all();

        if($users->count() == 0) {
            $this->command->info("please create some users !");
            return;
        }
        
        $nbPosts = (int)$this->command->ask("How many of post you want generate ?", 30);

        factory(App\Post::class, $nbPosts)->make()->each(function($post) use ($users) {
            $post->user_id = $users->random()->id;
            $post->save();
        });

    }
}

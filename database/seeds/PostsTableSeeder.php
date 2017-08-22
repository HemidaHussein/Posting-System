<?php

use Illuminate\Database\Seeder;
use App\Post;
class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->delete();
        for($i = 1; $i <= 50; $i++) {
            Post::create(array(
                'body' => 'Post no '. $i.'  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse tristique erat vestibulum nisl sagittis, eget venenatis neque hendrerit. In lobortis laoreet tempor.'
            ));
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    static $commentable_type = ['user', 'event'];
    public function run()
    {
	    DB::table('comments')->insert([
		    'body' => str_random(10, 60),
		    'commentable_id' => rand(1,100),
		    'commentable_type' => self::$commentable_type[rand(0, count(self::$commentable_type)-1)],
	    ]);
    }
}

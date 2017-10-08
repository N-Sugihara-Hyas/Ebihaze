<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    static $category = ['meeting', 'sharing', 'etc'];

    public function run()
    {
	    DB::table('events')->insert([
			'title' => str_random(10),
			'category' => self::$category[rand(0, count(self::$category)-1)],
			'schedule' => date('Y-m-d', rand(strtotime('-3month'), strtotime('+6month'))),
			'period' => null,
			'notification' => rand(0,1),
			'content' => 'This is the Content for '.str_random(50),
			'parties' => str_random(20),
			'suppliers' => str_random(20),
			'document' => str_random(40),
			'location' => rand(100,200).'.'.rand(111111, 999999).' '.rand(200,300).'.'.rand(111111,999999),
			'conditions' => str_random(20),
			'message' => 'Message is '.str_random(30),
			'approval' => rand(0,1),
			'etc' => null,
	    ]);
    }
}

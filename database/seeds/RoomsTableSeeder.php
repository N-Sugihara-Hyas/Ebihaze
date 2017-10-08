<?php

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    static $floor_plan = ['R', 'K', 'DK', 'LDK'];
    public function run()
    {
	    DB::table('rooms')->insert([
	    	'room_number' => '#'.rand(1,999).'号',
	        'floor' => rand(1,88).'F',
	        'floor_plan' => rand(1,5).self::$floor_plan[rand(0, count(self::$floor_plan)-1)],
	        'building_id' => rand(0,100),
	    ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class TradersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('traders')->insert([
		    'name' => str_random(10),
	        'tel' => '090'.rand(1000, 9999).rand(1000, 9999),
		    'address' => str_random(10),
		    'area' => str_random(10),
		    'introduction' => str_random(10),
	        'user_id' => rand(1,100)
	    ]);
    }
}

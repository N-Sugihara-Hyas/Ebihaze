<?php

use Illuminate\Database\Seeder;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('apartments')->insert([
	        'name' => str_random(5),
	        'address' => str_random(30),
	        'contact' => rand(0,1),
	        'control' => str_random(6),
	        'construction' => str_random(6),
	        'pet' => str_random(4),
	        'facilities' => str_random(10),
	        'completion_date' => rand(1900,date('Y')),
	        'insurance' => str_random(20),
	        'total_units' => rand(10,300),
	        'introduction' => 'Test Introduction '.str_random(30),
	        'official' => rand(0,1),
	        'public' => rand(0,1),
	    ]);
    }
}

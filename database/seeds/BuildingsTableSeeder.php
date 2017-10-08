<?php

use Illuminate\Database\Seeder;

class BuildingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('buildings')->insert([
			'name' => str_random(5).' ビルディング',
	        'apartment_id' => rand(1,100),
	    ]);
    }
}

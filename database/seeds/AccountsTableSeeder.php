<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('accounts')->insert([
		    'amount' => rand(100000, 1000000),
		    'name' => str_random(6),
	        'schedule' => date('Y-m-d H:i:s', strtotime('+'.rand(1, 12).'month')),
	        'category' => str_random(6),
	        'user_id' => rand(1,100),
	        'sub_id' => rand(1,100),
	    ]);
    }
}

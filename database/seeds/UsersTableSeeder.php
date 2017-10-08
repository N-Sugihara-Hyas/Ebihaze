<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    static $gender = ['male', 'female', 'unknown'];
    static $type = ['app', 'officer', 'common ', 'trader'];
    static $owned = ['owner', 'rent', 'treader'];
    static $reside = ['residents', 'rentout', 'trader'];
	static $trader = ['collaborator', 'trader'];

    public function run()
    {
	    DB::table('users')->insert([
		    'name' => str_random(10),
		    'email' => str_random(10).'@gmail.com',
		    'password' => bcrypt('secret'),
	        'tel' => '090'.rand(1000, 9999).rand(1000, 9999),
	        'nickname' => str_random(10),
	        'gender' =>  self::$gender[rand(0, count(self::$gender)-1)],
	        'birthday' => rand(1900, 1999).rand(0,12).rand(1,31),
	        'job' => str_random(5),
	        'fam' => null,
	        'pet' => null,
	        'certification' => true,
	        'type' => self::$type[rand(0, count(self::$type)-1)],
	        'owned' => self::$owned[rand(0, count(self::$owned)-1)],
	        'reside' => self::$reside[rand(0, count(self::$reside)-1)],
	        'trader' => self::$trader[rand(0, count(self::$trader)-1)],
	        'approval' => 1,
	        'membership' => true,
	        'apartment_id' => null,
	        'building_id' => null,
	        'room_id' => null,
		    'remember_token' => str_random(10),
	    ]);
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

	        $table->string('tel')->unique();
	        $table->string('nickname');
	        $table->string('gender');
	        $table->string('birthday');
	        $table->string('job');
	        $table->string('fam');
	        $table->string('pet');
	        $table->boolean('certification')->comment('SMS認証');//!SMS認証
	        $table->string('type')->comment('[app, officer, common / trader]');//[app, officer, common / trader] TODO::Trader?
			$table->string('owned')->comment('[owner, rent, treader]');//[owner, rent, treader] TODO::Trader?
			$table->string('reside')->comment('[residents, rentout, trader]');//[residents, rentout, trader]
			$table->string('trader')->commnet('[none, collaborator, trader]');//[none, collaborator, trader]
			$table->tinyInteger('approval')->coment('[0:temporary, 1:authorized, 9:expired]');//[temporary, authorized, expired]
			$table->boolean('membership')->comment('[0: 無料, 1:有料]');//[0: 無料, 1:有料]
	        $table->integer('apartment_id');
	        $table->integer('building_id');
	        $table->integer('room_id');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

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
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();

	        $table->string('tel')->unique();
	        $table->string('nickname')->nullable();
	        $table->string('gender')->nullable();
	        $table->string('birthday')->nullable();
	        $table->string('job')->nullable();
	        $table->string('fam')->nullable();
	        $table->string('pet')->nullable();
	        $table->boolean('certification')->default(0)->comment('SMS認証');//!SMS認証
	        $table->string('auth_token')->nullable();
	        $table->boolean('notification')->default(0)->comment('他者通知可否');
	        $table->string('type')->nullable()->comment('[app, officer, common / trader]');//[app, officer, common / trader] TODO::Trader?
			$table->string('owned')->nullable()->comment('[owner, rent, treader]');//[owner, rent, treader] TODO::Trader?
			$table->string('reside')->nullable()->comment('[residents, rentout, trader]');//[residents, rentout, trader]
			$table->string('trader')->nullable()->commnet('[none, collaborator, trader]');//[none, collaborator, trader]
			$table->tinyInteger('approval')->default(0)->coment('[0:temporary, 1:authorized, 9:expired]');//[temporary, authorized, expired]
			$table->boolean('membership')->default(0)->comment('[0: 無料, 1:有料]');//[0: 無料, 1:有料]
	        $table->integer('apartment_id')->nullable();
	        $table->integer('building_id')->nullable();
	        $table->integer('room_id')->nullable();
	        $table->string('flyer_ids')->nullable()->commnet('保存チラシのIDs');
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

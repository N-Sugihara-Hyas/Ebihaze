<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('name');
	        $table->string('address')->nullable();
	        $table->boolean('contact')->comment('0:不可, 1:可');
	        $table->string('control')->nullable()->comment('管理形態');
	        $table->string('construction')->nullable()->comment('構造');
	        $table->string('pet')->nullable()->comment('ペット');
	        $table->string('facilities')->nullable()->comment('付帯設備');
	        $table->string('completion_date')->nullable()->comment('竣工年月');
	        $table->string('insurance')->nullable()->comment('保険情報');
	        $table->integer('total_units')->nullable()->comment('総戸数');
	        $table->text('introduction')->nullable()->comment('マンション紹介テキスト');
	        $table->boolean('official')->comment('0:非公式, 1:公式');
	        $table->boolean('public')->comment('0:リストに出さない, 1:リストに出す');
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
        Schema::dropIfExists('apartments');
    }
}

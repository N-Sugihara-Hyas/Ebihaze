<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');

	        $table->string('title')->nullable()->comment('案件名');
	        $table->string('category')->comment('案件種類[management, event, meeting, sharing、etc]');
			// TODO::SUBCATEGORY $table->string('sub_category')->nullable();
			$table->date('schedule')->nullable()->comment('予定日');
			$table->string('period')->nullable()->comment('周期');
			$table->boolean('notification')->comment('通知有無');
			$table->text('content')->nullable()->comment('内容');
			$table->text('parties')->nullable()->comment('住民関係者');
			$table->string('suppliers')->nullable()->comment('担当業者');
			$table->string('document')->nullable()->comment('チラシなど書類');
			$table->string('location')->nullable()->comment('位置情報');
			$table->string('conditions')->nullable()->comment('条件');
			$table->text('message')->nullable()->comment('メッセージ');
			$table->boolean('approval')->comment('承認フラグ[0:未承認, 1:承認済み]');
			$table->text('etc')->nullable()->comment('出欠など予備カラム');

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
        Schema::dropIfExists('events');
    }
}
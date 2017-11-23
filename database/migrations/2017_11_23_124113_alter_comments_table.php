<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('comments', function (Blueprint $table) {
		    $table->integer('is_image')->after('body')->nullable()->comment('画像コメントフラグ');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('comments', function (Blueprint $table) {
		    $table->dropColumn('is_image');
	    });
    }
}

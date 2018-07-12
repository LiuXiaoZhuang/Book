<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsCompleteToNovelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('novel', function (Blueprint $table) {
            $table->tinyInteger('is_complete')->default('1')->comment('是否完本（1 为完本 , 2 连载中）')->after('descrpition');
            $table->integer('update_time')->default('0')->comment('更新时间')->after('descrpition');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('novel', function (Blueprint $table) {
            //
        });
    }
}

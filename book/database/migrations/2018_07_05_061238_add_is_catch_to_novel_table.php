<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsCatchToNovelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('novel', function (Blueprint $table) {
            $table->tinyInteger('is_catch')->default('2')->comment('是否已经抓取过（1 是 , 2 不是）');
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

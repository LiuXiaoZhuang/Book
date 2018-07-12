<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRecodeToBookshelfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookshelf', function (Blueprint $table) {
            $table->integer('inner_page')->default('0')->comment('页数')->after('novel_id');
            $table->integer('novel_chapter_id')->comment('小说章节id')->after('novel_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookshelf', function (Blueprint $table) {
            //
        });
    }
}

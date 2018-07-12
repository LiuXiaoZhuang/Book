<?php

use App\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovelRelationTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'novel_relation';

    /**
     * Run the migrations.
     * @table novel_relation
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id')->comment('编号');
            $table->integer('novel_id')->comment('小说id');
            $table->string('type', 100)->default('')->comment('类型（使用orm类名）');
            $table->integer('action_id')->comment('关联id');
            $table->integer('create_time')->default('0')->comment('创建时间');

            $table->index(["type"], 'type');

            $table->index(["novel_id"], 'novel_id');

            $table->index(["action_id"], 'action_id');

            $table->comment='小说关联表';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}

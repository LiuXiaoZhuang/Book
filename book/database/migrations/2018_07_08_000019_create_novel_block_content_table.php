<?php

use App\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovelBlockContentTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'novel_block_content';

    /**
     * Run the migrations.
     * @table novel_block_content
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id')->comment('编号');
            $table->integer('novel_block_id')->comment('小说板块id');
            $table->integer('novel_id')->comment('小说id');
            $table->integer('sort')->default('0')->comment('排序（从小到大）');
            $table->integer('create_time')->default('0')->comment('创建时间');
            $table->tinyInteger('status')->default('1')->comment('状态（0 为禁用 , 1 正常）');
            $table->text('remark')->nullable()->default(null)->comment('备注');

            $table->index(["sort"], 'sort');

            $table->index(["status"], 'status');

            $table->index(["novel_id"], 'novel_id');

            $table->index(["novel_block_id"], 'novel_block_id');

            $table->comment='小说板块内容表';
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

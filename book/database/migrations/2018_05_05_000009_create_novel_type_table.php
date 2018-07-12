<?php

use App\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovelTypeTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'novel_type';

    /**
     * Run the migrations.
     * @table novel_type
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id')->comment('编号');
            $table->char('name', 20)->default('')->comment('类型名称');
            $table->integer('gid')->default('0')->comment('父id');
            $table->integer('level')->default('1')->comment('层级');
            $table->integer('create_time')->default('0')->comment('创建时间');
            $table->tinyInteger('status')->default('1')->comment('状态（0 为禁用 , 1 正常）');
            $table->text('remark')->nullable()->default(null)->comment('备注');

            $table->index(["status"], 'status');

            $table->index(["gid"], 'gid');

            $table->index(["level"], 'level');

            $table->comment='小说类型表';
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

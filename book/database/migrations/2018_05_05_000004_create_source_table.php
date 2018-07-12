<?php

use App\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSourceTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'source';

    /**
     * Run the migrations.
     * @table source
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id')->comment('编号');
            $table->string('name')->default('')->comment('文件名称');
            $table->text('url')->nullable()->default(null)->comment('资源链接');
            $table->char('type', 10)->default('')->comment('img,doc,pdf,xls,txt,zip,apk,vedio,other');
            $table->double('size')->default('0')->comment('文件大小（kb）');
            $table->integer('width')->default('0')->comment('图片宽度');
            $table->integer('height')->default('0')->comment('图片高度');
            $table->integer('create_time')->default('0')->comment('创建时间');
            $table->tinyInteger('status')->default('1')->comment('状态（0 为禁用 , 1 正常）');
            $table->text('remark')->nullable()->default(null)->comment('备注');

            $table->index(["status"], 'status');

            $table->index(["type"], 'type');

            $table->comment='文件资源表';
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

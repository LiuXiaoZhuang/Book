<?php

use App\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'ad';

    /**
     * Run the migrations.
     * @table ad
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id')->comment('编号');
            $table->tinyInteger('type')->default('1')->comment('类型（1 banner , 2 随机广告）');
            $table->string('name', 100)->default('');
            $table->string('desc', 100)->default('');
            $table->integer('img')->default('0')->comment('图片id');
            $table->string('url')->default('')->comment('跳转链接');
            $table->tinyInteger('nav_type')->default('1')->comment('跳转类型（1 web页面 , 2 小程序内部跳转[内页]，3 小程序内部跳转[tag页]，4 跳小程序）');
            $table->integer('create_time')->default('0')->comment('创建时间');
            $table->tinyInteger('status')->default('1')->comment('状态（0 为禁用 , 1 正常）');
            $table->text('remark')->nullable()->default(null)->comment('备注');

            $table->index(["status"], 'status');

            $table->index(["type"], 'type');

            $table->comment='广告表';
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

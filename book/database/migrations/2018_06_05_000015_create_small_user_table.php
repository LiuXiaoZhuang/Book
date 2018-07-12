<?php

use App\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmallUserTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'small_user';

    /**
     * Run the migrations.
     * @table small_user
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('编号');
            $table->string('openid',300)->default('')->comment('微信标识');
            $table->string('nickname', 50)->default('')->comment('昵称');
            $table->tinyInteger('gender')->default('0')->comment('性别，1 男，2 女，0 未知');
            $table->string('city', 50)->default('')->comment('城市');
            $table->string('province', 50)->default('')->comment('省份');
            $table->string('country', 50)->default('')->comment('国家');
            $table->string('language', 50)->default('zh_CN')->comment('语言');
            $table->string('avatarurl',300)->default('')->comment('头像');
            $table->string('unionid',300)->default('')->comment('开发平台标识');
            $table->string('appid',300)->default('')->comment('小程序appid');
            $table->integer('create_time')->default('0')->comment('创建时间');
            $table->tinyInteger('status')->default('1')->comment('状态（0 为禁用 , 1 正常）');
            $table->text('remark')->nullable()->default(null)->comment('备注');

            $table->index(["status"], 'status');

            $table->index(["openid"], 'openid');

            $table->index(["appid"], 'appid');

            $table->index(["unionid"], 'unionid');

            $table->comment='小程序用户表';
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

<?php

use App\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTokenTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'customer_token';

    /**
     * Run the migrations.
     * @table customer_token
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('编号');
            $table->integer('customer_id')->comment('用户id');
            $table->string('token',300)->default('')->comment('登录标识');
            $table->string('session_key',300)->default('')->comment('小程序登录标识');
            $table->integer('update_time')->default('0')->comment('更新时间');
            $table->integer('create_time')->default('0')->comment('创建时间');
            $table->tinyInteger('status')->default('1')->comment('状态（0 为禁用 , 1 正常）');

            $table->index(["status"], 'status');

            $table->index(["token"], 'token');

            $table->index(["customer_id"], 'customer_id');

            $table->comment='用户登录标识表';
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

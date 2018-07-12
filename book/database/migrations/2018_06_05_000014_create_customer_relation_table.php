<?php

use App\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerRelationTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'customer_relation';

    /**
     * Run the migrations.
     * @table customer_relation
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id')->comment('编号');
            $table->integer('customer_id')->comment('用户id');
            $table->string('type', 50)->default('')->comment('类型（orm模型名称）');
            $table->integer('action_id')->comment('关联id');
            $table->integer('create_time')->default('0')->comment('创建时间');

            $table->index(["customer_id"], 'customer_id');

            $table->index(["type"], 'type');

            $table->index(["action_id"], 'action_id');

            $table->comment='用户关联表';
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

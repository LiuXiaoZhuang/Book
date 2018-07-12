<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * 初始化管理员
 */
class ManagerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('manager')->truncate();
        $manager=array(
		    'account'=>'admin',
		    'phone'=>'',
		    'password'=>bcrypt('duanshuiliu'),
		    'create_time'=>time(),
		    'status'=>1,
		    'remark'=>'超级管理员帐号',
        );
        DB::table('manager')->insert($manager);
    }
}

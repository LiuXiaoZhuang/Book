<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NovelTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('novel_type')->truncate();
        $list=array(
            '玄幻魔法',
            '武侠修真',
            '现代都市',
            '言情小说',
            '历史军事',
            '游戏竞技',
            '科幻灵异',
            '耽美同人',
            '其他小说',
        );
        $data=array();
        $time=time();
        foreach($list as $v){
        	$data[]=array(
        		'name'=>$v,
				'gid'=>0,
				'level'=>1,
				'create_time'=>$time,
				'status'=>1,
				'remark'=>'',
        	);
        }
        DB::table('novel_type')->insert($data);
    }
}

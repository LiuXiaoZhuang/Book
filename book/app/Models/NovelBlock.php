<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NovelBlock extends Model
{
    /**
	 * 表名
	 * @var [type]
	 */
    protected $table='novel_block';

    /**
     * 主键
     * @var string
     */
    protected $primaryKey='id';

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;


    /**
	 * 黑名单属性
	 *
	 * @var array
	 */
	protected $guarded = [];


	/**
     * 板块内容
     * @return [type] [description]
     */
    public function novelBlockContent()
    {
        return $this->hasMany('App\Models\NovelBlockContent','novel_block_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NovelChapter extends Model
{
    /**
	 * 表名
	 * @var [type]
	 */
    protected $table='novel_chapter';

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
     * 属于小说
     */
    public function novel()
    {
        return $this->belongsTo('App\Models\Novel','novel_id','id');
    }
}

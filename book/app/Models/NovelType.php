<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NovelType extends Model
{
    /**
	 * 表名
	 * @var [type]
	 */
    protected $table='novel_type';

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
     * 小说类型
     */
    public function novel()
    {
        return $this->belongsToMany('App\Models\Novel','novel_relation', 'action_id', 'novel_id')->wherePivot('type', 'NovelType');
    }
}

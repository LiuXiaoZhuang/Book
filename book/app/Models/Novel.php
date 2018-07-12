<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{
    /**
	 * 表名
	 * @var [type]
	 */
    protected $table='novel';

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
     * 拥有章节
     * @return [type] [description]
     */
    public function novelChapter()
    {
        return $this->hasMany('App\Models\NovelChapter','novel_id','id');
    }


    /**
     * 板块内容
     * @return [type] [description]
     */
    public function novelBlockContent()
    {
        return $this->hasMany('App\Models\NovelBlockContent','novel_id','id');
    }


    /**
     * 拥有书架
     * @return [type] [description]
     */
    public function bookshelf()
    {
        return $this->hasMany('App\Models\Bookshelf','novel_id','id');
    }


    /**
     * 小说类型
     */
    public function novelType()
    {
        return $this->belongsToMany('App\Models\NovelType','novel_relation', 'novel_id', 'action_id')->wherePivot('type', 'NovelType');
    }

    /**
     * 封面图片
     */
    public function coverImg()
    {
        return $this->belongsTo('App\Models\Source','cover_img','id');
    }
}

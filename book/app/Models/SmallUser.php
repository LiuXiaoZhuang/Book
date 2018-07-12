<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmallUser extends Model
{
    /**
	 * 表名
	 * @var [type]
	 */
    protected $table='small_user';

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
     * 用户
     * @return [type] [description]
     */
    public function customer(){
        return $this->belongsToMany('App\Models\Customer', 'customer_relation', 'action_id', 'customer_id')->wherePivot('type', 'SmallUser');
    }
}

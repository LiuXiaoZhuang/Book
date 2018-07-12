<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
	 * 表名
	 * @var [type]
	 */
    protected $table='customer';

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
     * 用户头像
     */
    public function headImg()
    {
        return $this->belongsTo('App\Models\Source','head_img','id');
    }


    /**
     * 拥有书架（收藏的书）
     * @return [type] [description]
     */
    public function bookshelf()
    {
        return $this->hasMany('App\Models\Bookshelf','customer_id','id');
    }

    /**
     * 登录标识
     * @return [type] [description]
     */
    public function token(){
        return $this->hasMany('App\Models\CustomerToken','customer_id','id');
    }

    /**
     * 小程序用户
     * @return [type] [description]
     */
    public function smallUser(){
        return $this->belongsToMany('App\Models\SmallUser', 'customer_relation', 'customer_id', 'action_id')->wherePivot('type', 'SmallUser');
    }

    /**
     * 创建唯一帐号
     * @param  [type] $user [description]
     * @return [type]       [description]
     */
    public function createOnlyAccount($user){
        $account=md5(encrypt('id:'.$user->id.' create_time:'.time().' rand:'.rand(10000,99999).' key:断水流'));
        $other_user=$this->where('account',$account)->first();
        if(!empty($other_user)){
            $this->createOnlyAccount($user);
        }
        $user->account=$account;
        $user->save();
    }
}

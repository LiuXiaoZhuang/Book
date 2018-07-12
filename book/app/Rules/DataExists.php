<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use GlobalValue;

class DataExists implements Rule
{
    /**
     * 保存的key
     * @var string
     */
    private $saveKey='';

    /**
     * 模型
     * @var null
     */
    private $model=null;

    /**
     * 函数
     * @var null
     */
    private $func=null;

    /**
     * 是否判断存在
     * @var boolean
     */
    private $exist=true;

    /**
     * 错误数据
     * @var string
     */
    private $msg='不存在该数据';

    /**
     * 初始化
     * @param [type]  $key   保存的键
     * @param string  $model orm模型
     * @param string  $msg   错误信息
     * @param boolean $exist 验证是否存在
     * @param [type]  $func  回调函数（query）
     */
    public function __construct($key,$model='',$msg='',$exist=true,$func=null)
    {
        $this->saveKey=$key;
        if(!empty($model)){
            $this->model=new $model();
        }

        $this->func=$func;
        $this->exist=$exist;
        $this->msg=$msg;
    }


    /**
     * 获取model
     * @return [type] [description]
     */
    public function getModel(){
        return $this->model;
    }

    /**
     * 设置模型
     * @param [type] $model [description]
     */
    public function setModel($model){
        $this->model=$model;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $query=$this->model->newQuery();
        if($this->func!==null){
            call_user_func($this->func,$query,$value);
        }else{
            $query->where('id',$value);
        }
        $obj=$query->first();
        GlobalValue::setValidateData($this->saveKey,$obj);
        if(!empty($obj)){
            return $this->exist;
        }else{
            return !$this->exist;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->msg;
    }
}

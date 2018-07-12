<?php

namespace App\Libs;

class ApiReturn
{
	/**
	 * 接口返回状态
	 * 1 成功
	 * 2 失败
	 * 3 登录失效
	 * 4 没有权限
	 * 5 非法请求（加密无效）
	 * @var integer
	 */
	private $status=1;

	/**
	 * 错误信息
	 * @var string
	 */
	private $error='';

	/**
	 * 具体数据
	 * @var array
	 */
	private $data=array();

    /**
     * 模版页面前缀
     * @var string
     */
    private $prefixView='';

    /**
     * 模版页面
     * @var string
     */
    private $view='';

    /**
     * 返回数据类型
     * @var string
     */
    private $returnType='json';

	/**
	 * 设置状态值
	 * @param [type]
	 */
    public function setStatus($status)
    {
        $this->status=$status;
        return $this;
    }

    /**
     * 请求成功
     */
    public function success(){
    	return $this->setStatus(1);
    }

    /**
     * 请求失败
     */
    public function fail(){
    	return $this->setStatus(2);
    }

    /**
     * 登录失效
     */
    public function loginInvalid(){
    	return $this->setStatus(3);
    }

    /**
     * 没有权限
     */
    public function notAuthorized(){
    	return $this->setStatus(4);
    }

    /**
     * 非法请求
     */
    public function unlawful(){
    	return $this->setStatus(5);
    }

    /**
     * 设置错误信息
     * @param string
     */
    public function setError($error=''){
    	$this->error=$error;
    	return $this;
    }

    /**
     * 设置数据
     * @param $data 数据
     * @param $is_object 是否为对象
     */
    public function setData($data=array(),$is_object=false){
    	if($is_object){
            if(empty($data)){
    		    $data=(object)$data;
            }
    	}
    	$this->data=$data;
    	return $this;
    }

    /**
     * 设置模版页面
     * @param string $view 模版名称
     * @param bool $is_complete 是否为全路径
     */
    public function setPrefixView($path=''){
        $this->prefixView=$path;
        return $this;
    }


    /**
     * 设置模版页面
     * @param string $view 模版名称
     * @param bool $is_complete 是否为全路径
     */
    public function setView($view,$is_complete=false){
        if($is_complete){
            $this->view=$view;
        }else{
            $this->view=$this->prefixView.$view;
        }
        return $this;
    }
    /**
     * 返回json类型数据
     */
    public function json(){
        $this->returnType='json';
        return $this;
    }

    /**
     * 返回base64 后的json类型数据
     */
    public function base64(){
        $this->returnType='base64';
        return $this;
    }

    /**
     * 返回view数据
     */
    public function view(){
        $this->returnType='view';
        return $this;
    }

    /**
     * 输出数据
     * @return [type]
     */
    public function response(){
    	$data=array(
    		'status'=>$this->status,
    		'data'=>$this->data,
    		'error'=>$this->error,
    	);

        switch ($this->returnType) {
            case 'view':
                if(!empty($this->view)){
                    return response()->view($this->view,$data,200);
                }else{
                    return response()->json($data, 200);
                }
                break;
            case 'base64':
                return response(base64_encode($data),200)->header('Content-Type', 'text/plain');
                break;
            default:
                return response()->json($data, 200);
                break;
        }
    }
}
<?php

namespace App\Http\Controllers\Customer\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EasyWeChat;
use App\Models\SmallUser;
use App\Models\Customer;
use App\Models\CustomerToken;
use ApiReturn;
use App\Exceptions\AccountException;

class LoginController extends Controller
{
    public function login(Request $request){
    	$app=EasyWeChat::miniProgram();
    	$res=$app->auth->session($request->input('code'));
    	$token=$this->createOrUpdataUser($res['session_key'],$res['openid']);
    	$data=array(
    		'token'=>$token,
    	);
    	return ApiReturn::success()->setData($data)->response();
    }

    /**
     * 创建或更新用户
     * @param  [type] $session_key [description]
     * @param  [type] $openid      [description]
     * @return [type]              [description]
     */
    private function createOrUpdataUser($session_key,$openid){
    	$small_user=SmallUser::where('openid',$openid)->first();
    	$customer=null;
    	if(empty($small_user)){
    		//创建小程序用户
    		$small_user=$this->createSmallUser($openid);
    		//创建用户
    		$customer=$this->createCustomer();
    		//关联用户和小程序用户
    		$this->relationSmallUserAndCustomer($customer,$small_user);
    	}else{
    		if($small_user->status!=1){
    			throw new AccountException('帐号被冻结');
    		}
    		$customer=$small_user->customer()->first();
    		if(empty($customer)){
    			//创建用户
	    		$customer=$this->createCustomer();
	    		//关联用户和小程序用户
	    		$this->relationSmallUserAndCustomer($customer,$small_user);
    		}
    	}
    	if($customer->status!=1){
			throw new AccountException('帐号被冻结');
		}
		//生成token
		$token=$this->createToken($customer,$session_key);
		return $token;
    }

    /**
     * 创建小程序用户
     * @param  [type] $openid [description]
     * @return [type]         [description]
     */
    private function createSmallUser($openid){
    	$data=array(
    		'openid'=>$openid,
    		'create_time'=>time(),
    		'remark'=>'',
    	);
    	$small_user=SmallUser::create($data);
    	return $small_user;
    }

    /**
     * 创建用户
     * @return [type] [description]
     */
    private function createCustomer(){
    	$data=array(
    		'account'=>'',
    		'create_time'=>time(),
    		'status'=>1,
    		'remark'=>'',
    	);
    	$customer=Customer::create($data);
    	$customer->createOnlyAccount($customer);
    	return $customer;
    }

    /**
     * 关联用户和小程序用户
     * @param  [type] $customer   [description]
     * @param  [type] $small_user [description]
     * @return [type]             [description]
     */
    private function relationSmallUserAndCustomer($customer,$small_user){
    	$data=array(
    		'create_time'=>time(),
    		'type'=>'SmallUser',
    	);
    	$customer->smallUser()->attach($small_user->id, $data);
    }

    /**
     * 创建登录标识
     * @param  [type] $customer   [description]
     * @param  [type] $small_user [description]
     * @return [type]             [description]
     */
    private function createToken($customer,$session_key){
    	//将之前的设为失效
    	CustomerToken::where('customer_id',$customer->id)->update(array('status'=>2));
    	$time=time();
    	$token_str=md5(encrypt('id:'.$customer->id.' create_time:'.$time.' session_key:'.$session_key));
    	$data=array(
		    'customer_id'=>$customer->id,
		    'token'=>$token_str,
		    'session_key'=>$session_key,
		    'update_time'=>$time,
		    'create_time'=>$time,
		    'status'=>1,
    	);
    	$token=CustomerToken::create($data);
    	return $token_str;
    }
}

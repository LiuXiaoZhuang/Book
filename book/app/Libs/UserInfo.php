<?php

namespace App\Libs;

class UserInfo
{
	/**
	 * 用户
	 * @var null
	 */
	private $customer=null;

	/**
	 * 小程序用户
	 * @var null
	 */
	private $smallUser=null;


	/**
	 * 接口登录标识
	 * @var null
	 */
	private $token=null;

	/**
	 * 设置用户
	 * @param [type] $customer [description]
	 */
	public function setCustomer($customer){
		$this->customer=$customer;
		return $this;
	}

	/**
	 * 获取用户
	 * @param [type] $customer [description]
	 */
	public function getCustomer(){
		return $this->customer;
	}


	/**
	 * 设置小程序用户
	 * @param [type] $customer [description]
	 */
	public function setSmallUser($small_user){
		$this->smallUser=$small_user;
		return $this;
	}

	/**
	 * 获取小程序用户
	 * @param [type] $customer [description]
	 */
	public function getSmallUser(){
		return $this->smallUser;
	}

	/**
	 * 设置接口登录标识
	 * @param [type] $customer [description]
	 */
	public function setToken($token){
		$this->token=$token;
		return $this;
	}

	/**
	 * 获取接口登录标识
	 * @param [type] $customer [description]
	 */
	public function getToken(){
		return $this->token;
	}
}

?>
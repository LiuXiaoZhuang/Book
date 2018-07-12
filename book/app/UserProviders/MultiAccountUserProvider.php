<?php

namespace App\UserProviders;

use Illuminate\Support\Str;
use Illuminate\Auth\EloquentUserProvider;

/**
 * 多帐号登录
 */
class MultiAccountUserProvider extends EloquentUserProvider{

	/**
	 * 提交的字段
	 * @var string
	 */
	private $requestField='';

	/**
	 * 数据库对应的查询字段
	 * @var array
	 */
	private $accountFields=array();

	/**
	 * 设置提交字段
	 * @param [type]
	 */
	public function setMultiAccount($request_field='',$account_fields=array()){
		$this->requestField=$request_field;
		$this->accountFields=$account_fields;
	}

	/**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials) || (count($credentials) === 1 && array_key_exists('password', $credentials))) {
            return;
        }

        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.
        $query = $this->createModel()->newQuery();

        foreach ($credentials as $key => $value) {
            if (! Str::contains($key, 'password')) {
            	if(!empty($this->requestField) && !empty($this->accountFields)){
            		if($this->requestField==$key){
            			$query->where(function($query) use($value){
            				foreach($this->accountFields as $account){
            					$query->orWhere($account,$value);
	            			}
            			});
            			continue;
            		}
            	}
                $query->where($key, $value);
            }
        }
        return $query->first();
    }
}
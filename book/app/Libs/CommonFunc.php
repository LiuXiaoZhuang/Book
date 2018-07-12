<?php

namespace App\Libs;

class CommonFunc
{

	/**
	 * http get方法
	 * @param  [type] $url   链接
	 * @param  [type] $param [description]
	 * @return [type]        [description]
	 */
	public function httpGet($url){
		$curl_obj = curl_init();
        if(stripos($url,"https://")!==FALSE){
            curl_setopt($curl_obj, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl_obj, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($curl_obj, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }
        curl_setopt($curl_obj, CURLOPT_URL, $url);
        curl_setopt($curl_obj, CURLOPT_RETURNTRANSFER, 1 );
        $content = curl_exec($curl_obj);
        $status = curl_getinfo($curl_obj);
        curl_close($curl_obj);
        if(intval($status["http_code"])==200){
            return $content;
        }else{
            return false;
        }
	}

	/**
	 * [httpPost description]
	 * @param  [type] $url   [description]
	 * @param  [type] $data [description]
	 * @param  [type] $post_file [description]
	 * @return [type]        [description]
	 */
	public function httpPost($url,$param,$post_file=false){
		$curl_obj = curl_init();
        if(stripos($url,"https://")!==FALSE){
            curl_setopt($curl_obj, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl_obj, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl_obj, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }
        if (is_string($param) || $post_file) {
            $post_data = $param;
        } else {
            $post_arr = array();
            foreach($param as $key=>$val){
                $post_arr[] = $key."=".urlencode($val);
            }
            $post_data =  join("&", $post_arr);
        }
        curl_setopt($curl_obj, CURLOPT_URL, $url);
        curl_setopt($curl_obj, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($curl_obj, CURLOPT_POST,true);
        curl_setopt($curl_obj, CURLOPT_POSTFIELDS,$post_data);
        $content = curl_exec($curl_obj);
        $status = curl_getinfo($curl_obj);
        curl_close($curl_obj);
        if(intval($status["http_code"])==200){
            return $content;
        }else{
            return false;
        }

	}

    /**
     * 设置分页的参数
     * @param [type] $page [description]
     * @return  返回固定的分页格式
     */
    public function setPageData($page){
        $data=array(
            'current_page'=>$page['current_page'],//当前页
            'data'=>$page['data'],//页面数据
            'from'=>$page['from'],//从第[form]条
            'to'=>$page['to'],//到第[to]条
            'total_page'=>$page['last_page'],//总页数
            'total_data'=>$page['total'],//总数据数
        );
        return $data;
    }

    /**
     * 设置分页的参数
     * @param  [type] $request [description]
     * @param  [type] $query   [description]
     * @return 返回固定的分页格式
     */
    public function getPageDataFormQuery($request,$query){
        $rows = $request->filled('rows')?$request->input('rows'):env('PAGE_ROWS',15);
        $page=$query->paginate($rows)->toArray();
        return $this->setPageData($page);
    }

}
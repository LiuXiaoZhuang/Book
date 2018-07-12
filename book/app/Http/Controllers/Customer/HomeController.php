<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Common\AdTrait;
use ApiReturn;
use CommonFunc;
use GlobalValue;
use UserInfo;
use App\Models\NovelBlock;
use CacheData;

class HomeController extends Controller
{
	use AdTrait;
	/**
	 * 首页数据
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
    public function index(Request $request){
        //广告
    	$carousel=$this->getCarouselAd();
    	$banner=$this->getRandAd();

        $novel_block=CacheData::getNovelBlockData();

    	$data=array(
    		'carousel'=>$carousel,
			'banner'=>$banner,
            'novel_block'=>$novel_block,
    	);
    	return ApiReturn::success()->setView('home')->setData($data)->response();
    }

    /**
     * 获取信息的值
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function copyData(Request $request){
        $data=array(
            'info'=>'支付宝发红包啦！即日起还有机会额外获得余额宝消费红包！长按复制此消息，打开最新版支付宝就能领取！Aus5uR02YY',
        );
        return ApiReturn::success()->setData($data)->response();
    }

    /**
     * 搜索页面
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function search(Request $request){
        //
    }
    //pbjbi2zxc.bkt.clouddn.com
}
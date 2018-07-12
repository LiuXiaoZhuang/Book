<?php

namespace App\Traits\Common;
use CacheData;

trait AdTrait{

	/**
	 * 获取轮播图广告
	 * @return [type] [description]
	 */
	public function getCarouselAd(){
		$data=CacheData::getCarouselAd();
		return $data;
	}

	/**
	 * 随机广告
	 * @return [type] [description]
	 */
	public function getRandAd(){
		$data=CacheData::getRandAd();
		return $data;
	}
}
?>
<?php

namespace App\Http\Controllers\Customer;

use App\Models\Novel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ApiReturn;
use App\Models\NovelType;
use CacheData;

class NovelTypeController extends Controller
{
    /**
     * 小说类型列表
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function novelTypeList(Request $request){
        $data=CacheData::getNovelTypeData();
    	return ApiReturn::success()->setView('novel_type_list')->setData($data)->response();
    }

}

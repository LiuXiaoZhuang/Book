<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\YanQingNovelListEvent;
use App\Models\Novel;
use App\Events\YanQingNovelChapterEvent;
use JonnyW\PhantomJs\Client;
use QL\QueryList;
use CommonFunc;
use App\Facades\GlobalValue;
use App\Events\YanQingNovelChapterListEvent;
use ApiReturn;

//抓取小说
class GradNovelController extends Controller
{
    /**
     * 小说抓取
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function gradNovel(Request $request){
        $_url='http://www.xianqihaotianmi.com/book/allvisit-%s.html';
        for($i=1;$i<=370;$i++){
            $url=sprintf($_url,$i);
            event(new YanQingNovelListEvent($url));
        }
        return 'SUCCESS';
    }


    /**
     * 小说详情抓取
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function gradNovelDetail(Request $request){
        if($request->filled('novel_id')){
            $novel=Novel::where('id',$request->input('novel_id'))->first();
            if(!empty($novel) && $novel->is_catch==2){
                $novel->is_catch=1;
                $novel->save();
                event(new YanQingNovelChapterListEvent($request->input('novel_id')));
            }
            return redirect('/admin/novel_list');
        }
        return 'FAIL';
    }

    /**
     * 所有小说
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function novelList(Request $request){
        $query=Novel::orderBy('id','asc');
        $data=CommonFunc::getPageDataFormQuery($request,$query);
        return ApiReturn::success()->setView('novel_list')->setData($data)->response();
    }
}

/*
一，获取所有的小说，把小说的信息捕获好，

点击更新小说,获取所有的章节，捕获章节内容
 */

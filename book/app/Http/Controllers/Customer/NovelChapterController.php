<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Novel;
use ApiReturn;
use App\Models\NovelChapter;
use GlobalValue;
use App\Models\Bookshelf;
use App\Http\Requests\Customer\NovelChapter\NovelChapterDetailForm;
use UserInfo;


class NovelChapterController extends Controller
{
    /*
     * 章节详情
     */
    public function novelChapter(NovelChapterDetailForm $request) {
        $novel_chapter=GlobalValue::getValidateData('novel_chapter');
        $user=UserInfo::getCustomer();
        //获取用户是否已经将该书加入书架
        if(!empty($user)){
            $collection=Bookshelf::where('novel_id',$novel_chapter->novel_id)
                                    ->where('customer_id',$user->id)
                                    ->first();
            if(!empty($collection)){
                $collection->novel_chapter_id=$novel_chapter->id;
                $collection->save();
            }
        }
        $str='<br>　　搜索书旗吧(www.shuqiba.com)，看更新最快的书！';
        $novel_chapter->content=str_replace($str,'',$novel_chapter->content);
        $novel_chapter->save();
        $chapter_content=$novel_chapter->content;
        $chapter_content=explode('<br>', $chapter_content);

        //上一章
        $pre_chapter=NovelChapter::where('sort','<',$novel_chapter->sort)
                                    ->where('novel_id',$novel_chapter->novel_id)
                                    ->orderBy('sort','desc')
                                    ->first();
        if(!empty($pre_chapter)){
            $pre_chapter=$pre_chapter->id;
        }else{
            $pre_chapter=0;
        }

        //下一章
        $next_chapter=NovelChapter::where('sort','>',$novel_chapter->sort)
                                    ->where('novel_id',$novel_chapter->novel_id)
                                    ->orderBy('sort','asc')
                                    ->first();
        if(!empty($next_chapter)){
            $next_chapter=$next_chapter->id;
        }else{
            $next_chapter=0;
        }
        
        $data=array(
            'novel_id'=>$novel_chapter->novel_id,
            'novel_chapter_id'=>$novel_chapter->id,
            'name'=>$novel_chapter->name,
            'content'=>$chapter_content,
            'pre_chapter'=>$pre_chapter,
            'next_chapter'=>$next_chapter,
        );
        return ApiReturn::success()->setView('novel_chapter')->setData($data)->response();
    }
}

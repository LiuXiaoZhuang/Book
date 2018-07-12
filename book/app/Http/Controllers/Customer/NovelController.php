<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ApiReturn;
use CommonFunc;
use App\Models\Novel;
use App\Models\NovelChapter;
use App\Models\Bookshelf;
use App\Http\Requests\Customer\Novel\NovelListForm;
use App\Http\Requests\Customer\Novel\DetailNovelForm;
use GlobalValue;
use UserInfo;

class NovelController extends Controller
{
    /**
     * 小说列表
     * @param  NovelListForm $request [description]
     * @return [type]                 [description]
     */
    public function novelList(NovelListForm $request) {
        $query = Novel::where('status',1)->has('novelChapter')->with('coverImg');
        $this->setCondition($request,$query);
        $this->setOrder($request,$query);
        $data=CommonFunc::getPageDataFormQuery($request,$query);
        $list=array();
        foreach($data['data'] as $v){
            $cover_img=!empty($v['cover_img'])?$v['cover_img']['url']:env('NOVEL_DEFAULT_COVER','');
            $tmp=array(
                'novel_id'=>$v['id'],
                'name'=>$v['name'],
                'author'=>$v['author'],
                'introduce'=>$v['descrpition'],
                'update_time'=>$v['update_time'],
                'cover_img'=>$cover_img,
            );
            $list[]=$tmp;
        }
        $data['data']=$list;
        return ApiReturn::success()->setView('novel_list')->setData($data)->response();
    }

    /**
     * 设置条件
     * @param [type] $request [description]
     * @param [type] $query   [description]
     */
    private function setCondition($request,$query){
        if($request->filled('is_complete') && in_array($request->input('is_complete'),array(1,2))){
            $query->where('is_complete',$request->input('is_complete'));
        }
        if($request->filled('keywords')){
            $keywords='%'.$request->input('keywords').'%';
            $query->where(function($query) use($keywords){
                $query->orWhere('name','like',$keywords)
                        ->orWhere('author','like',$keywords);
            });
        }
        $novel_type=GlobalValue::getValidateData('novel_type');
        if(!empty($novel_type)){
            $query->whereHas('novelType',function($query) use($novel_type){
                $query->where('novel_type.id',$novel_type->id);
            });
        }
    }

    /**
     * 设置排序
     * @param [type] $request [description]
     * @param [type] $query   [description]
     */
    private function setOrder($request,$query){
        //$order
        $query->orderBy('update_time','desc');
    }

    /**
     * 小说详情
     * @return [type] [description]
     */
    public function novelDetail(DetailNovelForm $request){
        $novel=GlobalValue::getValidateData('novel');
        $cover_img=$novel->coverImg()->first();
        if(empty($cover_img)){
            $cover_img=env('NOVEL_DEFAULT_COVER','');
        }else{
            $cover_img=$cover_img->url;
        }
        $novel_type=$novel->novelType()->first();
        if(!empty($novel_type)){
            $novel_type=$novel_type->name;
        }else{
            $novel_type='其他小说';
        }
        //获取小说所有章节
        $chapter_list=NovelChapter::select('id as novel_chapter_id','name','sort')
                                    ->orderBy('sort','asc')
                                    ->where('novel_id',$novel->id)
                                    ->where('status',1)
                                    ->get();
        
        if(!empty($chapter_list)){
            $chapter_list=$chapter_list->toArray();
        }else{
            $chapter_list=array();
        }

        $user=UserInfo::getCustomer();
        //是否已经加入书架
        $is_collection=2;
        $record_novel_chapter_id=0;
        //获取用户是否已经将该书加入书架
        if(!empty($user)){
            $collection=Bookshelf::where('novel_id',$novel->id)
                                    ->where('customer_id',$user->id)
                                    ->first();
            if(!empty($collection)){
                $is_collection=1;
                $record_novel_chapter_id=$collection->novel_chapter_id;
            }
        }

        //获取章节内容
        $novel_chapter=GlobalValue::getValidateData('novel_chapter');
        if(!empty($novel_chapter)){
            //更新书架
            if(!empty($collection)){
                $collection->novel_chapter_id=$novel_chapter->id;
                $collection->save();
            }
            
            $chapter_content=$novel_chapter->content;
            $chapter_content=explode('<br>', $chapter_content);
            $novel_chapter=array(
                'novel_chapter_id'=>$novel_chapter->id,
                'name'=>$novel_chapter->name,
                'content'=>$chapter_content,
            );
        }

        $data=array(
            'novel_id'=>$novel->id,//小说id
            'name'=>$novel->name,//小说名称
            'author'=>$novel->author,//小说作者
            'novel_type'=>$novel_type,//小说类型
            'cover_img'=>$cover_img,
            'is_complete'=>$novel->is_complete,//是否完结
            'introduce'=>$novel->descrpition,//简介
            'update_time'=>$novel->update_time,//更新时间
            'chapter_list'=>$chapter_list,//章节列表
            'is_collection'=>$is_collection,//是否加入书架
            'novel_chapter_id'=>$record_novel_chapter_id,//最近阅读章节
            'novel_chapter'=>$novel_chapter,//小说章节
        );
        return ApiReturn::success()->setView('novel_detail')->setData($data)->response();
    }
}

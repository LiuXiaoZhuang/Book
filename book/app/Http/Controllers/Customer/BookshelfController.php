<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ApiReturn;
use CommonFunc;
use App\Models\Bookshelf;
use App\Models\NovelChapter;
use App\Http\Requests\Customer\Bookshelf\AddBookForm;
use App\Http\Requests\Customer\Bookshelf\DelBookForm;
use App\Http\Requests\Customer\Bookshelf\SetTopForm;
use GlobalValue;
use UserInfo;
use App\Traits\Common\AdTrait;

class BookshelfController extends Controller
{
    use AdTrait;
	/**
	 * 我的书架
	 * @return [type] [description]
	 */
    public function index(Request $request){
    	$user=UserInfo::getCustomer();
    	$list=Bookshelf::where('customer_id',$user->id)
    					->whereHas('novel',function($query){
                            $query->where('novel.status',1)
                                    ->whereHas('novelChapter',function($query){
                                        $query->where('novel_chapter.status',1);
                                    });
                        })
    					->with(['novel'=>function($query){
    						$query->with('coverImg');
    					}])
    					->orderBy('inner_page','desc')
    					->orderBy('create_time','desc')
    					->with('novelChapter')
    					->get();
    	$data=array();
    	foreach($list as $v){
    		$cover_img=!empty($v->novel->coverImg)?$v->novel->coverImg->url:env('NOVEL_DEFAULT_COVER','');
    		$tmp=array(
                'bookshelf_id'=>$v->id,
    			'novel_id'=>$v->novel_id,
    			'name'=>$v->novel->name,
    			'author'=>$v->novel->author,
    			'cover_img'=>$cover_img,
    			'novel_chapter_id'=>0,
                'inner_page'=>$v->inner_page,
    			'read'=>'还没开始读呢',
    		);
    		if(!empty($v->novelChapter)){
    			$tmp['novel_chapter_id']=$v->novelChapter->id;
    			$tmp['read']='读至　'.$v->novelChapter->name;
    		}else{
                $novel_chapter=NovelChapter::where('novel_id',$v->novel_id)
                                            ->where('status',1)
                                            ->orderBy('sort','asc')
                                            ->first();
                $tmp['novel_chapter_id']=$novel_chapter->id;
            }
    		$data[]=$tmp;
    	}
        $ad=$this->getRandAd();
        $data=array(
            'books'=>$data,
            'banner'=>empty($ad)?null:$ad,
        );
    	return ApiReturn::success()->setView('bookshelf')->setData($data)->response();
    }

    /**
     * 加入书架
     * @param Request $request [description]
     */
    public function addBook(AddBookForm $request){
    	$user=UserInfo::getCustomer();
    	$novel=GlobalValue::getValidateData('novel');
    	$bookshelf=Bookshelf::where('customer_id',$user->id)
    						->where('novel_id',$novel->id)
    						->first();
    	if(empty($bookshelf)){
    		$data=array(
    			'customer_id'=>$user->id,//` int not null comment '用户id',
			    'novel_id'=>$novel->id,//` int not null comment '小说id',
			    'novel_chapter_id'=>0,//` int not null comment '小说章节id',
			    'inner_page'=>0,//` int not null default 0 comment '当前页数',
			    'create_time'=>time(),//` int not null default 0 comment '创建时间',
			    'status'=>1,//` tinyint(1) not null default 1 comment '状态（0 为禁用 , 1 正常）',
			    'remark'=>'',//` text comment '备注',
    		);
    		Bookshelf::create($data);
    	}
    	return ApiReturn::success()->setData(array('info'=>'加入书架成功'))->response();	
    }

    /**
     * 移出书架
     * @param Request $request [description]
     */
    public function delBook(DelBookForm $request){
    	$user=UserInfo::getCustomer();
    	$novel=GlobalValue::getValidateData('novel');
    	$bookshelf=Bookshelf::where('customer_id',$user->id)
    						->where('novel_id',$novel->id)
    						->delete();
    	return ApiReturn::success()->setData(array('info'=>'移出书架成功'))->response();
    }

    /**
     * 置顶的开启与取消
     */
    public function setTop(SetTopForm $request){
        $bookshelf=GlobalValue::getValidateData('bookshelf');
        $bookshelf->inner_page=$bookshelf->inner_page==1?0:1;
        $bookshelf->save();
        //return $this->index($request);
        return ApiReturn::success()->setData(array('info'=>'置顶成功'))->response();
    }
}

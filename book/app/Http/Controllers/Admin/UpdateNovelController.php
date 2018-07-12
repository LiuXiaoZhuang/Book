<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Novel;

//更新小说
class UpdateNovelController extends Controller
{
    public function updateNovel(Request $request){
        $novel_list=Novel::whereIn('id',$request->input('novel_ids'))
                        ->where('status',1)
                        ->where('is_complete',2)
                        ->get();
        foreach($novel_list as $novel){
            $last_novel_chapter=$novel->novelChapter()->orderBy('sort','desc')->first();
            if(!empty($last_novel_chapter)){
                //这里去执行最新的东西
                //event(new UpdateNOvel($novel->id,$novel->url,$last_novel_chapter->name,$last_novel_chapter->sort));
            }
        }
    }
}

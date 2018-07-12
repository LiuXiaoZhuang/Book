<?php

namespace App\Libs;
use Illuminate\Support\Facades\Cache;
use App\Models\Ad;
use App\Models\NovelBlock;
use App\Models\NovelType;

class CacheData
{
    /**
     * 轮播图
     * @return [type] [description]
     */
    public function getCarouselAd(){
        $data=Cache::get('carousel_ad');
        if(empty($data)){
            $list=Ad::where('status',1)->where('type',1)->has('adImg')->with('adImg')->get();
            $data=array();
            foreach($list as $v){
                $tmp=array(
                    'name'=>$v->name,
                    'desc'=>$v->desc,
                    'img'=>$v->adImg->url,
                    'url'=>$v->url,
                    'nav_type'=>$v->nav_type,
                );
                $data[]=$tmp;
            }
            Cache::forever('carousel_ad',$data);
        }
        return $data;
    }


    /**
     * 随机广告
     * @param  integer $num [description]
     * @return [type]       [description]
     */
    public function getRandAd($num=1){
        $data=Cache::get('rand_ad');
        if(empty($data)){
            $list=Ad::where('status',1)->where('type',2)->has('adImg')->with('adImg')->get();
            $data=array();
            foreach($list as $v){
                $tmp=array(
                    'name'=>$v->name,
                    'desc'=>$v->desc,
                    'img'=>$v->adImg->url,
                    'url'=>$v->url,
                    'nav_type'=>$v->nav_type,
                );
                $data[]=$tmp;
            }
            Cache::forever('rand_ad',$data);
        }
        $keys=array_rand($data,$num);
        $return_data=array();
        if(is_array($keys)){
            foreach($keys as $v){
                $return_data[]=$data[$v];
            }
        }else{
            $return_data=$data[$keys];
        }
        return $return_data;
    }

    /**
     * 小说模块
     * @return [type] [description]
     */
    public function getNovelBlockData(){
        $novel_block=Cache::get('novel_block');
        if(empty($novel_block)){
            $novel_block_list=NovelBlock::where('status',1)
                                    ->whereHas('novelBlockContent',function($query){
                                        $query->where('novel_block_content.status',1)
                                                ->whereHas('novel',function($query){
                                                    $query->where('novel.status',1);
                                                });
                                    })
                                    ->with(['novelBlockContent'=>function($query){
                                        $query->where('novel_block_content.status',1)
                                                ->with(['novel'=>function($query){
                                                    $query->where('novel.status',1)->with('coverImg');
                                                }])
                                                ->orderBy('novel_block_content.sort','asc');
                                    }])
                                    ->orderBy('sort','asc')
                                    ->get();

            $novel_block=array();
            if(!empty($novel_block_list)){
                foreach($novel_block_list as $v){
                    $novel_list=array();
                    foreach($v->novelBlockContent as $vv){
                        $cover_img=!empty($vv->novel->coverImg)?$vv->novel->coverImg->url:env('NOVEL_DEFAULT_COVER','');
                        $tmp2=array(
                            'novel_id'=>$vv->novel->id,
                            'name'=>$vv->novel->name,
                            'author'=>$vv->novel->author,
                            'introduce'=>$vv->novel->descrpition,
                            'cover_img'=>$cover_img,
                        );
                        $novel_list[]=$tmp2;
                    }
                    $tmp=array(
                        'name'=>$v->name,
                        'novel_list'=>$novel_list,
                    );
                    $novel_block[]=$tmp;
                }
            }
            Cache::forever('novel_block',$novel_block);
        }
        return $novel_block;
    }


    /**
     * 获取小说类型数据
     * @return [type] [description]
     */
    public function getNovelTypeData(){
        $data=Cache::get('novel_type');
        if(empty($data)){
            $field=array(
                'id as novel_type_id',
                'name',
            );
            $list=NovelType::select($field)->get();
            $data=array();
            if(!empty($list)){
                $data=$list->toArray();
            }
            Cache::forever('novel_type',$data);
        }
        return $data;
    }
}
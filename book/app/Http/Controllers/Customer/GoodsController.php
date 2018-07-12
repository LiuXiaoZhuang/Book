<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\Taobao;

class GoodsController extends Controller
{
    public function index(Request $request){
        $taobao=new Taobao();
        $c=$taobao->getTopClient();
        $req = $taobao->getTbkItemGetRequest();
        $req->setFields("num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url,seller_id,volume,nick");
        $req->setQ("女装");
        $req->setSort("tk_rate_des");
        $req->setStartPrice("1");
        $req->setPageSize("20");
        $resp = $c->execute($req);
        dd($resp);
    }
}

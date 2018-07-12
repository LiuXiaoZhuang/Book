<?php

namespace App\Libs;

require_once(app_path().'/Libs/Taobao/TopSdk.php');
use TopClient;
use TbkItemGetRequest;
use TbkItemConvertRequest;
use TbkItemRecommendGetRequest;
use TbkItemInfoGetRequest;
use TbkItemShareConvertRequest;
use TbkShopGetRequest;
use TbkShopRecommendGetRequest;
use TbkRebateAuthGetRequest;
use TbkRebateOrderGetRequest;
use TbkOrderGetRequest;
use TbkUatmEventGetRequest;
use TbkUatmEventItemGetRequest;
use TbkUatmFavoritesItemGetRequest;
use TbkUatmFavoritesGetRequest;
use TbkJuTqgGetRequest;
use TbkSpreadGetRequest;
use TbkItemGuessLikeRequest;
use TbkDgItemCouponGetRequest;
use TbkCouponGetRequest;
use TbkTpwdCreateRequest;
use TbkContentGetRequest;
use TbkDgNewuserOrderGetRequest;
use TbkScNewuserOrderGetRequest;
use TbkDgOptimusMaterialRequest;
use TbkScMaterialOptionalRequest;
use TbkDgMaterialOptionalRequest;
use TbkDgNewuserOrderSumRequest;
use TbkScNewuserOrderSumRequest;
use TbkScOptimusMaterialRequest;
use TbkScPublisherInfoSaveRequest;
use TbkScPublisherInfoGetRequest;
use TbkScInvitecodeGetRequest;
use TbkScGroupchatMessageSendRequest;
use TbkScGroupchatCreateRequest;
use TbkScGroupchatGetRequest;

class Taobao
{

    private $tbkObjects=array();

    /**
     * 主要操作对象
     * @return [type] [description]
     */
    public function getTopClient(){
        if(!array_key_exists('TopClient', $this->tbkObjects)){
            $client = new TopClient();
            $client->appkey = env('TBK_APPKEY','24959969');
            $client->secretKey = env('TBK_SECRETKEY','e7ee6d47f2c1454ae5c5250adadcf9f3');
            $this->tbkObjects['TopClient']=$client;
        }
        return $this->tbkObjects['TopClient'];
    }

    /**
     * 商品查询（请求对象）
     * 请求接口：taobao.tbk.item.get
     * 接口文档：http://open.taobao.com/api.htm?docId=24515&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkItemGetRequest(){
        if(!array_key_exists('ItemGetRequest', $this->tbkObjects)){
            $this->tbkObjects['ItemGetRequest']=new TbkItemGetRequest();
        }
        return $this->tbkObjects['ItemGetRequest'];
    }

    /**
     * 链接转换（请求对象）
     * 请求接口：taobao.tbk.item.convert
     * 接口文档：http://open.taobao.com/api.htm?docId=24516&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkItemConvertRequest(){
        if(!array_key_exists('ItemConvertRequest', $this->tbkObjects)){
            $this->tbkObjects['ItemConvertRequest']=new TbkItemConvertRequest();
        }
        return $this->tbkObjects['ItemConvertRequest'];
    }

    /**
     * 关联推荐查询（请求对象）
     * 请求接口：taobao.tbk.item.recommend.get
     * 接口文档：http://open.taobao.com/api.htm?docId=24517&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkItemRecommendGetRequest(){
        if(!array_key_exists('ItemRecommendGetRequest', $this->tbkObjects)){
            $this->tbkObjects['ItemRecommendGetRequest']=new TbkItemRecommendGetRequest();
        }
        return $this->tbkObjects['ItemRecommendGetRequest'];
    }

    /**
     * 商品详情（简版）（请求对象）
     * 请求接口：taobao.tbk.item.info.get
     * 接口文档：http://open.taobao.com/api.htm?docId=24518&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkItemInfoGetRequest(){
        if(!array_key_exists('ItemInfoGetRequest', $this->tbkObjects)){
            $this->tbkObjects['ItemInfoGetRequest']=new TbkItemInfoGetRequest();
        }
        return $this->tbkObjects['ItemInfoGetRequest'];
    }

    /**
     * 三方分成转换链接（请求对象）
     * 请求接口：taobao.tbk.item.share.convert
     * 接口文档：http://open.taobao.com/api.htm?docId=24519&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkItemShareConvertRequest(){
        if(!array_key_exists('ItemShareConvertRequest', $this->tbkObjects)){
            $this->tbkObjects['ItemShareConvertRequest']=new TbkItemShareConvertRequest();
        }
        return $this->tbkObjects['ItemShareConvertRequest'];
    }

    /**
     * 店铺查询（请求对象）
     * 请求接口：taobao.tbk.shop.get
     * 接口文档：http://open.taobao.com/api.htm?docId=24521&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkShopGetRequest(){
        if(!array_key_exists('ShopGetRequest', $this->tbkObjects)){
            $this->tbkObjects['ShopGetRequest']=new TbkShopGetRequest();
        }
        return $this->tbkObjects['ShopGetRequest'];
    }

    /**
     * 店铺关联推荐查询（请求对象）
     * 请求接口：taobao.tbk.shop.recommend.get
     * 接口文档：http://open.taobao.com/api.htm?docId=24522&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkShopRecommendGetRequest(){
        if(!array_key_exists('ShopRecommendGetRequest', $this->tbkObjects)){
            $this->tbkObjects['ShopRecommendGetRequest']=new TbkShopRecommendGetRequest();
        }
        return $this->tbkObjects['ShopRecommendGetRequest'];
    }

    /**
     * 返利授权查询（请求对象）
     * 请求接口：taobao.tbk.rebate.auth.get
     * 接口文档：http://open.taobao.com/api.htm?docId=24525&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkRebateAuthGetRequest(){
        if(!array_key_exists('RebateAuthGetRequest', $this->tbkObjects)){
            $this->tbkObjects['RebateAuthGetRequest']=new TbkRebateAuthGetRequest();
        }
        return $this->tbkObjects['RebateAuthGetRequest'];
    }

    /**
     * 返利订单查询（请求对象）
     * 请求接口：taobao.tbk.rebate.order.get
     * 接口文档：http://open.taobao.com/api.htm?docId=24526&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkRebateOrderGetRequest(){
        if(!array_key_exists('RebateOrderGetRequest', $this->tbkObjects)){
            $this->tbkObjects['RebateOrderGetRequest']=new TbkRebateOrderGetRequest();
        }
        return $this->tbkObjects['RebateOrderGetRequest'];
    }

    /**
     * 订单查询（请求对象）
     * 请求接口：taobao.tbk.order.get
     * 接口文档：http://open.taobao.com/api.htm?docId=24527&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkOrderGetRequest(){
        if(!array_key_exists('OrderGetRequest', $this->tbkObjects)){
            $this->tbkObjects['OrderGetRequest']=new TbkOrderGetRequest();
        }
        return $this->tbkObjects['OrderGetRequest'];
    }

    /**
     * 枚举指定淘客自己发起的，*正在进行中的*定向招商的活动列表（请求对象）
     * 请求接口：taobao.tbk.uatm.event.get
     * 接口文档：http://open.taobao.com/api.htm?docId=26449&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkUatmEventGetRequest(){
        if(!array_key_exists('UatmEventGetRequest', $this->tbkObjects)){
            $this->tbkObjects['UatmEventGetRequest']=new TbkUatmEventGetRequest();
        }
        return $this->tbkObjects['UatmEventGetRequest'];
    }

    /**
     * 获取淘宝联盟定向招商的宝贝信息（请求对象）
     * 请求接口：taobao.tbk.uatm.event.item.get
     * 接口文档：http://open.taobao.com/api.htm?docId=26616&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkUatmEventItemGetRequest(){
        if(!array_key_exists('UatmEventItemGetRequest', $this->tbkObjects)){
            $this->tbkObjects['UatmEventItemGetRequest']=new TbkUatmEventItemGetRequest();
        }
        return $this->tbkObjects['UatmEventItemGetRequest'];
    }

    /**
     * 获取淘宝联盟选品库的宝贝信息（请求对象）
     * 请求接口：taobao.tbk.uatm.favorites.item.get
     * 接口文档：http://open.taobao.com/api.htm?docId=26619&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkUatmFavoritesItemGetRequest(){
        if(!array_key_exists('UatmFavoritesItemGetRequest', $this->tbkObjects)){
            $this->tbkObjects['UatmFavoritesItemGetRequest']=new TbkUatmFavoritesItemGetRequest();
        }
        return $this->tbkObjects['UatmFavoritesItemGetRequest'];
    }

    /**
     * 获取淘宝联盟选品库列表（请求对象）
     * 请求接口：taobao.tbk.uatm.favorites.get
     * 接口文档：http://open.taobao.com/api.htm?docId=26620&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkUatmFavoritesGetRequest(){
        if(!array_key_exists('UatmFavoritesGetRequest', $this->tbkObjects)){
            $this->tbkObjects['UatmFavoritesGetRequest']=new TbkUatmFavoritesGetRequest();
        }
        return $this->tbkObjects['UatmFavoritesGetRequest'];
    }

    /**
     * 获取淘抢购的数据，淘客商品转淘客链接，非淘客商品输出普通链接（请求对象）
     * 请求接口：taobao.tbk.ju.tqg.get
     * 接口文档：http://open.taobao.com/api.htm?docId=27543&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkJuTqgGetRequest(){
        if(!array_key_exists('JuTqgGetRequest', $this->tbkObjects)){
            $this->tbkObjects['JuTqgGetRequest']=new TbkJuTqgGetRequest();
        }
        return $this->tbkObjects['JuTqgGetRequest'];
    }

    /**
     * 输入一个原始的链接，转换得到指定的传播方式，如二维码，淘口令，短连接； 现阶段只支持短连接（请求对象）
     * 请求接口：taobao.tbk.spread.get
     * 接口文档：http://open.taobao.com/api.htm?docId=27832&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkSpreadGetRequest(){
        if(!array_key_exists('SpreadGetRequest', $this->tbkObjects)){
            $this->tbkObjects['SpreadGetRequest']=new TbkSpreadGetRequest();
        }
        return $this->tbkObjects['SpreadGetRequest'];
    }

    /**
     * 猜你喜欢（请求对象）
     * 请求接口：taobao.tbk.item.guess.like
     * 接口文档：http://open.taobao.com/api.htm?docId=29528&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkItemGuessLikeRequest(){
        if(!array_key_exists('ItemGuessLikeRequest', $this->tbkObjects)){
            $this->tbkObjects['ItemGuessLikeRequest']=new TbkItemGuessLikeRequest();
        }
        return $this->tbkObjects['ItemGuessLikeRequest'];
    }

    /**
     * 好券清单API【导购】(优惠券)（请求对象）
     * 请求接口：taobao.tbk.dg.item.coupon.get
     * 接口文档：http://open.taobao.com/api.htm?docId=29821&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkDgItemCouponGetRequest(){
        if(!array_key_exists('DgItemCouponGetRequest', $this->tbkObjects)){
            $this->tbkObjects['DgItemCouponGetRequest']=new TbkDgItemCouponGetRequest();
        }
        return $this->tbkObjects['DgItemCouponGetRequest'];
    }

    /**
     * 阿里妈妈推广券信息查询。传入商品ID+券ID，或者传入me参数，均可查询券信息。（请求对象）
     * 请求接口：taobao.tbk.coupon.get
     * 接口文档：http://open.taobao.com/api.htm?docId=31106&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkCouponGetRequest(){
        if(!array_key_exists('CouponGetRequest', $this->tbkObjects)){
            $this->tbkObjects['CouponGetRequest']=new TbkCouponGetRequest();
        }
        return $this->tbkObjects['CouponGetRequest'];
    }

    /**
     * 淘宝客淘口令（请求对象）
     * 请求接口：taobao.tbk.tpwd.create
     * 接口文档：http://open.taobao.com/api.htm?docId=31127&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkTpwdCreateRequest(){
        if(!array_key_exists('TpwdCreateRequest', $this->tbkObjects)){
            $this->tbkObjects['TpwdCreateRequest']=new TbkTpwdCreateRequest();
        }
        return $this->tbkObjects['TpwdCreateRequest'];
    }

    /**
     * 淘客媒体内容输出（请求对象）
     * 请求接口：taobao.tbk.content.get
     * 接口文档：http://open.taobao.com/api.htm?docId=31137&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkContentGetRequest(){
        if(!array_key_exists('ContentGetRequest', $this->tbkObjects)){
            $this->tbkObjects['ContentGetRequest']=new TbkContentGetRequest();
        }
        return $this->tbkObjects['ContentGetRequest'];
    }

    /**
     * 淘宝客新用户订单API--导购（请求对象）
     * 请求接口：taobao.tbk.dg.newuser.order.get
     * 接口文档：http://open.taobao.com/api.htm?docId=33892&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkDgNewuserOrderGetRequest(){
        if(!array_key_exists('DgNewuserOrderGetRequest', $this->tbkObjects)){
            $this->tbkObjects['DgNewuserOrderGetRequest']=new TbkDgNewuserOrderGetRequest();
        }
        return $this->tbkObjects['DgNewuserOrderGetRequest'];
    }

    /**
     * 淘宝客新用户订单API--社交 （请求对象）
     * 请求接口：taobao.tbk.sc.newuser.order.get
     * 接口文档：http://open.taobao.com/api.htm?docId=33897&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkScNewuserOrderGetRequest(){
        if(!array_key_exists('ScNewuserOrderGetRequest', $this->tbkObjects)){
            $this->tbkObjects['ScNewuserOrderGetRequest']=new TbkScNewuserOrderGetRequest();
        }
        return $this->tbkObjects['ScNewuserOrderGetRequest'];
    }

    /**
     * 淘宝客物料下行-导购（请求对象）
     * 请求接口：taobao.tbk.dg.optimus.material
     * 接口文档：http://open.taobao.com/api.htm?docId=33947&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkDgOptimusMaterialRequest(){
        if(!array_key_exists('DgOptimusMaterialRequest', $this->tbkObjects)){
            $this->tbkObjects['DgOptimusMaterialRequest']=new TbkDgOptimusMaterialRequest();
        }
        return $this->tbkObjects['DgOptimusMaterialRequest'];
    }

    /**
     * 通用物料搜索API（请求对象）
     * 请求接口：taobao.tbk.sc.material.optional
     * 接口文档：http://open.taobao.com/api.htm?docId=35263&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkScMaterialOptionalRequest(){
        if(!array_key_exists('ScMaterialOptionalRequest', $this->tbkObjects)){
            $this->tbkObjects['ScMaterialOptionalRequest']=new TbkScMaterialOptionalRequest();
        }
        return $this->tbkObjects['ScMaterialOptionalRequest'];
    }

    /**
     * 通用物料搜索API（导购）（请求对象）
     * 请求接口：taobao.tbk.dg.material.optional
     * 接口文档：http://open.taobao.com/api.htm?docId=35896&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkDgMaterialOptionalRequest(){
        if(!array_key_exists('DgMaterialOptionalRequest', $this->tbkObjects)){
            $this->tbkObjects['DgMaterialOptionalRequest']=new TbkDgMaterialOptionalRequest();
        }
        return $this->tbkObjects['DgMaterialOptionalRequest'];
    }

    /**
     * 拉新活动汇总API--导购（请求对象）
     * 请求接口：taobao.tbk.dg.newuser.order.sum
     * 接口文档：http://open.taobao.com/api.htm?docId=36836&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkDgNewuserOrderSumRequest(){
        if(!array_key_exists('DgNewuserOrderSumRequest', $this->tbkObjects)){
            $this->tbkObjects['DgNewuserOrderSumRequest']=new TbkDgNewuserOrderSumRequest();
        }
        return $this->tbkObjects['DgNewuserOrderSumRequest'];
    }

    /**
     * 拉新活动汇总API--社交（请求对象）
     * 请求接口：taobao.tbk.sc.newuser.order.sum
     * 接口文档：http://open.taobao.com/api.htm?docId=36837&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkScNewuserOrderSumRequest(){
        if(!array_key_exists('ScNewuserOrderSumRequest', $this->tbkObjects)){
            $this->tbkObjects['ScNewuserOrderSumRequest']=new TbkScNewuserOrderSumRequest();
        }
        return $this->tbkObjects['ScNewuserOrderSumRequest'];
    }

    /**
     * 淘宝客擎天柱通用物料API - 社交（请求对象）
     * 请求接口：taobao.tbk.sc.optimus.material
     * 接口文档：http://open.taobao.com/api.htm?docId=37884&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkScOptimusMaterialRequest(){
        if(!array_key_exists('ScOptimusMaterialRequest', $this->tbkObjects)){
            $this->tbkObjects['ScOptimusMaterialRequest']=new TbkScOptimusMaterialRequest();
        }
        return $this->tbkObjects['ScOptimusMaterialRequest'];
    }

    /**
     * 淘宝客渠道信息备案 - 社交（请求对象）
     * 请求接口：taobao.tbk.sc.publisher.info.save
     * 接口文档：http://open.taobao.com/api.htm?docId=37988&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkScPublisherInfoSaveRequest(){
        if(!array_key_exists('ScPublisherInfoSaveRequest', $this->tbkObjects)){
            $this->tbkObjects['ScPublisherInfoSaveRequest']=new TbkScPublisherInfoSaveRequest();
        }
        return $this->tbkObjects['ScPublisherInfoSaveRequest'];
    }

    /**
     * 淘宝客信息查询 - 社交（请求对象）
     * 请求接口：taobao.tbk.sc.publisher.info.get
     * 接口文档：http://open.taobao.com/api.htm?docId=37989&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkScPublisherInfoGetRequest(){
        if(!array_key_exists('ScPublisherInfoGetRequest', $this->tbkObjects)){
            $this->tbkObjects['ScPublisherInfoGetRequest']=new TbkScPublisherInfoGetRequest();
        }
        return $this->tbkObjects['ScPublisherInfoGetRequest'];
    }

    /**
     * 淘宝客邀请码生成-社交（请求对象）
     * 请求接口：taobao.tbk.sc.invitecode.get
     * 接口文档：http://open.taobao.com/api.htm?docId=38046&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkScInvitecodeGetRequest(){
        if(!array_key_exists('ScInvitecodeGetRequest', $this->tbkObjects)){
            $this->tbkObjects['ScInvitecodeGetRequest']=new TbkScInvitecodeGetRequest();
        }
        return $this->tbkObjects['ScInvitecodeGetRequest'];
    }

    /**
     * 手淘群发单（请求对象）
     * 请求接口：taobao.tbk.sc.groupchat.message.send
     * 接口文档：http://open.taobao.com/api.htm?docId=38243&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkScGroupchatMessageSendRequest(){
        if(!array_key_exists('ScGroupchatMessageSendRequest', $this->tbkObjects)){
            $this->tbkObjects['ScGroupchatMessageSendRequest']=new TbkScGroupchatMessageSendRequest();
        }
        return $this->tbkObjects['ScGroupchatMessageSendRequest'];
    }

    /**
     * 手淘群创建（请求对象）
     * 请求接口：taobao.tbk.sc.groupchat.create
     * 接口文档：http://open.taobao.com/api.htm?docId=38262&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkScGroupchatCreateRequest(){
        if(!array_key_exists('ScGroupchatCreateRequest', $this->tbkObjects)){
            $this->tbkObjects['ScGroupchatCreateRequest']=new TbkScGroupchatCreateRequest();
        }
        return $this->tbkObjects['ScGroupchatCreateRequest'];
    }

    /**
     * 手淘群查询（请求对象）
     * 请求接口：taobao.tbk.sc.groupchat.get
     * 接口文档：http://open.taobao.com/api.htm?docId=38263&docType=2#s3
     * @return [type] [description]
     */
    public function getTbkScGroupchatGetRequest(){
        if(!array_key_exists('ScGroupchatGetRequest', $this->tbkObjects)){
            $this->tbkObjects['ScGroupchatGetRequest']=new TbkScGroupchatGetRequest();
        }
        return $this->tbkObjects['ScGroupchatGetRequest'];
    }
}
<?php

namespace App\Libs;
use JonnyW\PhantomJs\Client;

class GlobalValue
{
    /**
     * 设备类型
     * @var [type]
     */
    private $device;

    /**
     * 设置设备类型
     * @param [type] $device [description]
     */
    public function setDevice($device){
        $this->device=$device;
        return $this;
    }

    /**
     * 获取设备类型
     * @param [type] $device [description]
     */
    public function getDevice($device){
        $this->device=$device;
        return $this;
    }

    /**
     * 验证层所需要保留的数据
     * @var [type]
     */
    private $validateSaveData=array();

    /**
     * 设置验证层所保留的数据
     */
    public function setValidateData($key,$value){
        $this->validateSaveData[$key]=$value;
        return $this;
    }

    /**
     * 设置验证层所保留的数据
     */
    public function getValidateData($key){
        if(array_key_exists($key, $this->validateSaveData)){
            return $this->validateSaveData[$key];
        }

        return null;
    }


    private $phantomJS=null;

    public function setPhantomJS(){
        $client = Client::getInstance();
        $client->getEngine()->setPath(env('PHANTOM_JS_PATH'));
        $client->getEngine()->addOption('--ignore-ssl-errors=true');
        //$client->getEngine()->addOption('--output-encoding=gbk');
        //$client->getEngine()->addOption('--output-encoding=gb2312');
        //$client->getEngine()->addOption('--script-encoding=gbk');
        //\Log::info($client->getEngine()->getOptions());
        $client->isLazy();
        $this->phantomJS=$client;
    }


    public function getPhantomJS(){
        return $this->phantomJS;
    }

}

<?php

namespace app\api\controller\v1;
use app\api\controller\BaseController;
use app\api\model\Config as ConfigModel;
use app\api\validate\Config as ConfigValidate;

class Config extends BaseController
{
	protected $beforeActionList = [
       'checkPrimaryScope' => ['except' => 'index']
    ];

    public function index(){
    	$res=ConfigModel::getConfig();
        return $this->res($res,"获取配置成功!");
    }
}
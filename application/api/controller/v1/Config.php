<?php

namespace app\api\controller\v1;
use app\api\controller\BaseController;
use app\api\model\Config as ConfigModel;

class Config extends BaseController
{
	  protected $beforeActionList = [
       'checkPrimaryScope' => ['except' => '']
    ];

    public function index(){
        $data=input('post.');
        $data['limit']=intval($data['limit']??0)?:10;
        $data['page']=intval($data['page']??0)?:1;
    	  $res=ConfigModel::getConfig($data);
        return $this->res($res,"获取配置成功!");
    }
    public function add(){
        $data=input('post.');
    	  $res=ConfigModel::addConfig($data);
        return $this->res($res,"新增配置成功!");
    }
    public function edit(){
        $data=input('post.');
    	  $res=ConfigModel::editConfig($data);
        return $this->res([],"编辑配置成功!");
    }
    public function del(){
        $id=input('post.id');
    	  ConfigModel::delConfig($id);
        return $this->res([],"删除配置成功!");
    }
}
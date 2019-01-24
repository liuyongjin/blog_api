<?php

namespace app\api\controller\v1;
use app\api\controller\BaseController;
use app\api\model\Config as ConfigModel;
use app\api\validate\Config as ConfigValidate;

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
        (new ConfigValidate())->goCheck();
        $data=input('post.');
    	ConfigModel::addConfig($data);
        return $this->res([],"新增配置成功!");
    }
    public function edit(){
        (new ConfigValidate())->scene('edit')->goCheck();
        $data=input('post.');
    	$res=ConfigModel::editConfig($data);
        return $this->res([],"编辑配置成功!");
    }
    public function del(){
        (new ConfigValidate())->scene('del')->goCheck();
        $id=input('post.id');
    	ConfigModel::delConfig($id);
        return $this->res([],"删除配置成功!");
    }
    public function bdel(){
        (new ConfigValidate())->scene('bdel')->goCheck();
        // $ids=json_decode(input('post.ids'));
        $ids=input('post.ids');
    	ConfigModel::bdelConfig($ids);
        return $this->res([],"批量删除配置成功!");
    }
}
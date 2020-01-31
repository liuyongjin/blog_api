<?php

namespace app\api\controller\v1;
use app\api\controller\BaseController;
use app\api\model\Info as InfoModel;

class Info extends BaseController
{
	protected $beforeActionList = [
    'checkPrimaryScope' => ['except' => 'updateInfo']
  ];

  public function updateInfo(){
    $data=input('post.');
    InfoModel::editInfo($data);
    return $this->res([],"更新信息成功!");
  }
}
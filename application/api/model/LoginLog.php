<?php

namespace app\api\model;
use app\lib\exception\BaseException;
use app\api\model\BaseModel;

class LoginLog extends BaseModel
{
    public static function saveLog($data)
    {
        $log = self::create($data);
        if(!$log){
            throw new BaseException(
            [
                'msg' => '新增标签失败',
                'errorCode'=>1
            ]);
        }
    }
}
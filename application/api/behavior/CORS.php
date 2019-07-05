<?php
// tp5.1的写法
namespace app\api\behavior;

use think\Request;

class CORS
{
    public function appInit($params)
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        header("Access-Control-Allow-Headers: token,Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: POST,GET');
        if(request()->isOptions()){
            exit();
        }
    }
}
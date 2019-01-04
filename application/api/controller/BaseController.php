<?php
namespace app\api\controller;
use think\Controller;

class BaseController extends Controller
{
    // 0成功，1失败
    public function res($data=[],$msg='',$code=0,$status=200){
        $res['code']=$code;
        $res['data']=$data;
        $res['msg']=$msg;
        return json($res,$status)->header(['Content-Type' => 'application/json']);
    }
}
<?php
namespace app\api\controller;
use think\Controller;
use app\api\service\Token;

class BaseController extends Controller
{
    // 0成功，1失败
    public function res($data=[],$msg='',$errorCode=0,$code=200){
        $res['errorCode']=$errorCode;
        $res['data']=$data;
        $res['msg']=$msg;
        return json($res,$code)->header(['Content-Type' => 'application/json']);
    }
    //后台身份验证
    protected function checkPrimaryScope()
    {
        Token::needPrimaryScope();
    }
    //前台会员验证
    // protected function checkMemberIdentity()
    // {
    //     Token::verifyIdentity();
    // }
}
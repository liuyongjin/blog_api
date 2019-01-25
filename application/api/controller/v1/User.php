<?php
namespace app\api\controller\v1;
use app\api\controller\BaseController;
use app\api\model\User as UserModel;
use app\api\validate\User as UserValidate;
class User extends BaseController
{
    protected $beforeActionList = [
       'checkPrimaryScope' => ['only' => 'modifyInfo,logout']
    ];
    public function login()
    {
        (new UserValidate())->goCheck();
    	$data=input('post.');
        if($token=UserModel::loginUser($data)){
          $res['token']=$token;
        }
        return $this->res($res,'登录成功');
    }
    public function register()
    {
        (new UserValidate())->goCheck();
    	$data=input('post.');
        if(UserModel::registerUser($data)){
            return $this->res([],'注册成功');
        }else{
            return $this->res([],'注册失败',1);
        }
    }
    public function logout()
    {
        if(UserModel::logoutUser()){
            return $this->res([],'退出成功');
        }else{
            return $this->res([],'退出登录失败',1);
        }
    }
    public function modifyInfo(){
        (new UserValidate())->scene('edit')->goCheck();
    	$data=input('post.');
        if(UserModel::modifyUser($data)){
            return $this->res([],'修改成功');
        }else{
            return $this->res([],'修改失败',1);
        }
    }
}
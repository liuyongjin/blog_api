<?php
namespace app\api\controller\v1;
use app\api\controller\BaseController;
use app\api\model\User as UserModel;
use app\api\service\Token as TokenService;
use app\api\validate\Login;
class User extends BaseController
{
    public function login()
    {
        (new Login())->goCheck();
    	// $data=input('post.');
        // var_dump($data);
        // $data=UserModel::getUser();
        $data=TokenService::generateToken();
        return $this->res($data,'生成结果');
    }
}
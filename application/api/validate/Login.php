<?php
namespace app\api\validate;

class Login extends BaseValidate
{
    protected $rule = [
        'username' => 'require',
        'password' => 'require'
    ];
    
    protected $message=[
        'username' => '请输入账号',
        'password' => '请输入密码'
    ];
    // protected $scene = [
    //     'edit'  =>  ['username','password'],
    // ];
     // edit 验证场景定义
     public function sceneEdit()
     {
         return $this->only(['username','password','nickname'])->append('nickname', 'require');
     }  
}

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
}

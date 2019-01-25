<?php
namespace app\api\validate;

class Member extends BaseValidate
{
    protected $rule = [
        'username' => 'require',
        'password' => 'require',
        'code'=>'require'
    ];
    
    protected $message=[
        'username' => '请输入账号',
        'password' => '请输入密码',
        'code'=>'请输入验证码'
    ];
    // edit 验证场景定义
    public function sceneEdit()
    {
        return $this->only(['username','id'])->append('id', 'require|isPositiveInteger');
    }  
    // del 验证场景定义
    public function sceneDel()
    {
        return $this->only(['id'])->append('id', 'require|isPositiveInteger');
    }  
    // bdel 验证场景定义
    public function sceneBdel()
    {
        return $this->only(['ids'])->append('ids', 'require|array');
    }  

}
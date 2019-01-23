<?php
namespace app\api\validate;

class Tag extends BaseValidate
{
    protected $rule = [
        'name' => 'require',
        'des' => 'require'
    ];
    
    protected $message=[
        'name' => '请输入标签名称',
        'des' => '请输入标签描述'
    ];
    // add 验证场景定义
    public function sceneAdd()
    {
        return $this->only(['name']);
    }  
    // edit 验证场景定义
    public function sceneEdit()
    {
        return $this->only(['name','des','id'])->append('id', 'require|isPositiveInteger');
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
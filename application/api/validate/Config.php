<?php
namespace app\api\validate;

class Config extends BaseValidate
{
    protected $rule = [
        'config_name' => 'require',
        'config_value' => 'require'
    ];
    
    protected $message=[
        'config_name' => '请输入配置名称',
        'config_value' => '请输入配置描述'
    ];
    // edit 验证场景定义
    public function sceneEdit()
    {
        return $this->only(['config_name','config_value','id'])->append('id', 'require|isPositiveInteger');
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
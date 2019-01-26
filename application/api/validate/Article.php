<?php
namespace app\api\validate;

class Article extends BaseValidate
{
    protected $rule = [
        'title' => 'require',
        'description'=>'require',
        'main_img'=>'require'
    ];
    
    protected $message=[
        'title' => '文章标题不能为空',
        'description'=>'描述不能为空',
        'main_img'=>'主图不能为空'
    ];
    //add 验证场景定义
    public function sceneAdd()
    {
        return $this->only(['title','description','main_img','tag_id'])->append('tag_id', 'require|isPositiveInteger');
    }  
    // edit 验证场景定义
    public function sceneEdit()
    {
        return $this->only(['title','description','main_img','id'])->append('id', 'require|isPositiveInteger');
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

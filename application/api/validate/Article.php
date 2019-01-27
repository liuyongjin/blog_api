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
    //index 验证场景定义
    public function sceneIndex()
    {
        return $this->only(['tag_id'])->append('tag_id', 'require|isPositiveInteger');
    }  
    //add 验证场景定义
    public function sceneAdd()
    {
        return $this->only(['title','description','main_img','tags_id'])->append('tags_id', 'require|array');
    }  
    // edit 验证场景定义
    public function sceneEdit()
    {
        return $this->only(['title','description','main_img','id','tags_id'])->append('id', 'require|isPositiveInteger')->append('tags_id', 'require|array');
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

<?php
namespace app\api\validate;

class Article extends BaseValidate
{
    protected $rule = [
        'title' => 'require',
        'des'=>'require',
        'main_img'=>'require',
        'content'=>'require'
    ];
    
    protected $message=[
        'title' => '文章标题不能为空',
        'des'=>'描述不能为空',
        'main_img'=>'主图不能为空',
        'content'=>'内容不能为空'
    ];
    //index 验证场景定义
    public function sceneIndex()
    {
        return $this->only(['tags_id'])->append('tags_id', 'array');
    }  
    //search 验证场景定义
    public function sceneSearch()
    {
        return $this->only(['tag_id'])->append('tag_id', 'isPositiveInteger');
    }  
    //detail 验证场景定义
    public function sceneDetail()
    {
        return $this->only(['id'])->append('id', 'require|isPositiveInteger');
    }  
    //updateStatus 验证场景定义
    public function sceneUpdateStatus()
    {
        return $this->only(['id','status'])->append('id', 'require|isPositiveInteger')->append('status', 'require|isStatus');
    }  
    //add 验证场景定义
    public function sceneAdd()
    {
        return $this->only(['title','des','main_img','tags_id','content'])->append('tags_id', 'require|array');
    }  
    // edit 验证场景定义
    public function sceneEdit()
    {
        return $this->only(['title','des','main_img','id','tags_id','content'])->append('id', 'require|isPositiveInteger')->append('tags_id', 'require|array');
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

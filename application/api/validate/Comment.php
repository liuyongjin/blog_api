<?php
namespace app\api\validate;

class Comment extends BaseValidate
{
    protected $rule = [
        'article_id' => 'require',
        // 'member_id' => 'require',
        'comment'=>'require'
    ];
    
    protected $message=[
        'article_id' => '文章id不能为空',
        // 'member_id' => '请输入密码',
        'comment'=>'请输入评论'
    ];
    // edit 验证场景定义
    public function sceneEdit()
    {
        return $this->only(['article_id','comment','id'])->append('id', 'require|isPositiveInteger');
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
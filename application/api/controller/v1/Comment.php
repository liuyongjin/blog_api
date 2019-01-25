<?php

namespace app\api\controller\v1;
use app\api\controller\BaseController;
use app\api\model\Comment as CommentModel;
use app\api\validate\Comment as CommentValidate;
// 前台会员使用的接口
class Comment extends BaseController
{
	  protected $beforeActionList = [
       'checkMemberIdentity' => ['except' => '']
    ];

    public function index(){
        $data=input('post.');
        $data['limit']=intval($data['limit']??0)?:10;
        $data['page']=intval($data['page']??0)?:1;
    	  $res=CommentModel::getComment($data);
        return $this->res($res,"获取评论成功!");
    }
    public function add(){
        (new CommentValidate())->goCheck();
        $data=input('post.');
    	CommentModel::addComment($data);
        return $this->res([],"新增评论成功!");
    }
    public function edit(){
        (new CommentValidate())->scene('edit')->goCheck();
        $data=input('post.');
    	  CommentModel::editComment($data);
        return $this->res([],"编辑评论成功!");
    }
    public function del(){
        (new CommentValidate())->scene('del')->goCheck();
        $id=input('post.id');
    	  CommentModel::delComment($id);
        return $this->res([],"删除评论成功!");
    }
    public function bdel(){
        (new CommentValidate())->scene('bdel')->goCheck();
        $ids=input('post.ids');
    	  CommentModel::bdelComment($ids);
        return $this->res([],"批量删除评论成功!");
    }
}
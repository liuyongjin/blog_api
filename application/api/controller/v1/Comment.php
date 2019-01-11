<?php

namespace app\api\controller\v1;
use app\api\controller\BaseController;
use app\api\model\Comment as CommentModel;

class Comment extends BaseController
{
	  protected $beforeActionList = [
       'checkPrimaryScope' => ['except' => '']
    ];

    public function index(){
        $data=input('post.');
        $data['limit']=intval($data['limit']??0)?:10;
        $data['page']=intval($data['page']??0)?:1;
    	  $res=CommentModel::getComment($data);
        return $this->res($res,"获取评论成功!");
    }
    public function add(){
        $data=input('post.');
    	  $res=CommentModel::addComment($data);
        return $this->res($res,"新增评论成功!");
    }
    public function edit(){
        $data=input('post.');
    	  $res=CommentModel::editComment($data);
        return $this->res([],"编辑评论成功!");
    }
    public function del(){
        $id=input('post.id');
    	  CommentModel::delComment($id);
        return $this->res([],"删除评论成功!");
    }
    public function bdel(){
        $ids=input('post.ids');
    	  CommentModel::bdelComment($ids);
        return $this->res([],"批量删除评论成功!");
    }
}
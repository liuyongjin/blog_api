<?php

namespace app\api\controller\v1;
use app\api\controller\BaseController;
use app\api\model\Tag as TagModel;
use app\api\validate\Tag as TagValidate;

class Tag extends BaseController
{
	protected $beforeActionList = [
       'checkPrimaryScope' => ['except' => '']
    ];

    public function index(){
        $data=input('post.');
        $data['limit']=intval($data['limit']??0)?:10;
        $data['page']=intval($data['page']??0)?:1;
    	$res=TagModel::getTag($data);
        return $this->res($res,"获取标签成功!");
    }
    public function add(){
        (new TagValidate())->scene('add')->goCheck();
        $data=input('post.');
    	TagModel::addTag($data);
        return $this->res([],"新增标签成功!");
    }
    public function edit(){
        (new TagValidate())->scene('edit')->goCheck();
        $data=input('post.');
    	TagModel::editTag($data);
        return $this->res([],"编辑标签成功!");
    }
    public function del(){
        (new TagValidate())->scene('del')->goCheck();
        $id=input('post.id');
    	TagModel::delTag($id);
        return $this->res([],"删除标签成功!");
    }
    public function bdel(){
        (new TagValidate())->scene('bdel')->goCheck();
        $ids=input('post.ids');
        // $ids=json_decode(input('post.ids'));
    	TagModel::bdelTag($ids);
        return $this->res([],"批量删除标签成功!");
    }
}
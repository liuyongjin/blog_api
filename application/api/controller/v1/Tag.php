<?php

namespace app\api\controller\v1;
use app\api\controller\BaseController;
use app\api\model\Tag as TagModel;
use app\api\validate\Tag as TagValidate;

class Tag extends BaseController
{
	protected $beforeActionList = [
       'checkPrimaryScope' => ['except' => 'index']
    ];

    public function index(){
        $data=input('post.');
        $data['pageSize']=intval($data['pageSize']??0)?:10;
        $data['current']=intval($data['current']??0)?:1;
        // $data['create_date']=isset($data['create_date'])?$data['create_date']:[];
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
        $ids=request()->post()['ids']; 
        $ids=implode(",", $ids);
    	TagModel::bdelTag($ids);
        return $this->res([],"批量删除标签成功!");
    }
}
<?php

namespace app\api\controller\v1;
use app\api\controller\BaseController;
use app\api\model\Member as MemberModel;
use app\api\validate\Member as MemberValidate;

class Member extends BaseController
{
    //会员注册接口不需要验证token
	protected $beforeActionList = [
       'checkPrimaryScope' => ['except' => 'add,login,logout']
    //    'checkMemberIdentity'=>['only' =>'edit']
    ];

    public function index(){
        $data=input('post.');
        $data['limit']=intval($data['limit']??0)?:10;
        $data['page']=intval($data['page']??0)?:1;
    	$res=MemberModel::getMember($data);
        return $this->res($res,"获取会员成功!");
    }
    public function add(){
        (new MemberValidate())->goCheck();
        $data=input('post.');
    	MemberModel::addMember($data);
        return $this->res([],"新增会员成功!");
    }
    // 登录
    public function login()
    {
        (new MemberValidate())->goCheck();
    	$data=input('post.');
        if($token=MemberModel::loginMember($data)){
          $res['token']=$token;
        }
        return $this->res($res,'登录成功');
    }
    // 退出登录
    public function logout()
    {
        if(MemberModel::logoutMember()){
            return $this->res([],'退出成功');
        }else{
            return $this->res([],'退出登录失败',1);
        }
    }
    public function edit(){
        (new MemberValidate())->scene('edit')->goCheck();
        $data=input('post.');
    	$res=MemberModel::editMember($data);
        return $this->res([],"编辑会员成功!");
    }
    public function del(){
        (new MemberValidate())->scene('del')->goCheck();
        $id=input('post.id');
    	MemberModel::delMember($id);
        return $this->res([],"删除会员成功!");
    }
    public function bdel(){
        (new MemberValidate())->scene('bdel')->goCheck();
        // $ids=json_decode(input('post.ids'));
        $ids=input('post.ids');
    	MemberModel::bdelMember($ids);
        return $this->res([],"批量删除会员成功!");
    }
}
<?php

namespace app\api\controller\v1;
use app\api\controller\BaseController;
use app\api\model\Article as ArticleModel;
use app\api\validate\Article as ArticleValidate;

class Article extends BaseController
{
	protected $beforeActionList = [
       'checkPrimaryScope' => ['except' => 'pigeonholeList,index,randomList,detail,praise,browse']
    ];

    public function index(){
        (new ArticleValidate())->scene('index')->goCheck();
        $data=input('post.');
        $data['pageSize']=intval($data['pageSize']??0)?:10;
        $data['current']=intval($data['current']??0)?:1;
    	$res=ArticleModel::getArticle($data);
        return $this->res($res,"获取文章成功!");
    }

    //前台博客归档接口
    public function pigeonholeList(){
        $res=ArticleModel::getPigeonhole();
        return $this->res($res,"获取文章成功!");
    }
    //随机文章获取
    public function randomList(){
        $data=input('post.');
        $data['pageSize']=intval($data['pageSize']??0)?:8;
        $res=ArticleModel::getRandomList($data);
        return $this->res($res,"获取文章成功!");
    }
    //获取文章详情
    public function detail(){
        (new ArticleValidate())->scene('detail')->goCheck();
        $data=input('post.');
        $res=ArticleModel::getDetail($data);
        return $this->res($res,"获取文章详情!");
    }
    //浏览量加一
    public function browse(){
        (new ArticleValidate())->scene('detail')->goCheck();
        $data=input('post.');
        $res=ArticleModel::browseInc($data);
        return $this->res($res,"操作成功!");
    }
    //点赞加一
    public function praise(){
        (new ArticleValidate())->scene('detail')->goCheck();
        $data=input('post.');
        $res=ArticleModel::praiseInc($data);
        return $this->res($res,"操作成功!");
    }
    public function add(){
        (new ArticleValidate())->scene('add')->goCheck();
        $data=input('post.');
    	ArticleModel::addArticle($data);
        return $this->res([],"新增文章成功!");
    }
    public function updateStatus(){
        (new ArticleValidate())->scene('updateStatus')->goCheck();
        $data=input('post.');
        ArticleModel::updateArticleStatus($data);
        return $this->res([],"更新文章状态成功!");
    }
    public function edit(){
        (new ArticleValidate())->scene('edit')->goCheck();
        $data=input('post.');
    	ArticleModel::editArticle($data);
        return $this->res([],"编辑文章成功!");
    }
    public function del(){
        (new ArticleValidate())->scene('del')->goCheck();
        $id=input('post.id');
    	ArticleModel::delArticle($id);
        return $this->res([],"删除文章成功!");
    }
    public function bdel(){
        (new ArticleValidate())->scene('bdel')->goCheck();
        $ids=input('post.ids');
    	ArticleModel::bdelArticle($ids);
        return $this->res([],"批量删除文章成功!");
    }
}
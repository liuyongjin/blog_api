<?php

namespace app\api\controller\v1;
use app\api\controller\BaseController;
use app\api\model\Article as ArticleModel;
use app\api\validate\Article as ArticleValidate;

class Article extends BaseController
{
	protected $beforeActionList = [
       'checkPrimaryScope' => ['except' => '']
    ];

    public function index(){
        $data=input('post.');
        $data['limit']=intval($data['limit']??0)?:10;
        $data['page']=intval($data['page']??0)?:1;
    	$res=ArticleModel::getArticle($data);
        return $this->res($res,"获取文章成功!");
    }
    public function add(){
        (new ArticleValidate())->scene('add')->goCheck();
        $data=input('post.');
    	ArticleModel::addArticle($data);
        return $this->res([],"新增文章成功!");
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
        $ids=input('post.id');
    	ArticleModel::bdelArticle($ids);
        return $this->res([],"批量删除文章成功!");
    }
}
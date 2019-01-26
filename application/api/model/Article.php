<?php

namespace app\api\model;
// use think\Model;
use app\lib\exception\BaseException;
use app\api\model\BaseModel;
// use think\model\concern\SoftDelete;
class Article extends BaseModel
{
    // use SoftDelete;
    // 定义多对多关系
    public function tags(){
        return $this->belongsToMany('tag','tag_article','tag_id','article_id');
    }

    public static function getArticle($data)
    {
        $article = static::with('tags')->limit($data['limit'])->page($data['page'])->select();
        if(!$article){
            throw new BaseException(
            [
                'msg' => '获取文章失败',
                'errorCode'=>1
            ]);
        }
        $count = static::with('tags')->limit($data['limit'])->page($data['page'])->count();
        $res['data']=$article;
        $res['total']=$count;
        return $res;
    }
    public static function addArticle($data)
    {
        // 启动事务
        Db::startTrans();
        try {
            $article = self::create($data);
            // 提交事务
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            throw new BaseException(
            [
                'msg' => '新增文章失败',
                'errorCode'=>1
            ]);
            Db::rollback();
        }
    }
    public static function editArticle($data)
    {
        $article = (new Article)->save($data,['id' => $data['id']]);
        if(!$article){
            throw new BaseException(
            [
                'msg' => '编辑文章失败',
                'errorCode'=>1
            ]);
        }
    }
    public static function delArticle($id)
    {
        // var_dump(self::destroy($id));
        // exit;
        // $article = self::get($id)->delete();
        $article = self::destroy($id);
        if(!$article){
            throw new BaseException(
            [
                'msg' => '删除文章失败',
                'errorCode'=>1
            ]);
        }
    }
    public static function bdelArticle($ids)
    {
        $article =self::destroy($ids);
        if(!$article){
            throw new BaseException(
            [
                'msg' => '批量删除文章失败',
                'errorCode'=>1
            ]);
        }
    }
}
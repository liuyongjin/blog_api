<?php

namespace app\api\model;
// use think\Model;
use app\lib\exception\BaseException;
use app\api\model\BaseModel;
use think\Db;
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
        if(isset($data['tag_id'])){
            //条件
            $where=[
                [
                    'tag_id','=',$data['tag_id']
                ]
            ];
           $tag_article=db('tag_article')->where($where)->select(); 
           foreach ($tag_article as $key => $value) {
               $article_ids[]=$value['article_id'];
           }
        }
        //  var_dump($article_ids);
        //  exit;
        // $subSql = static::with('tags')->limit($data['limit'])->page($data['page'])->buildSql();
        // $article =Db::table($subSql . ' article')->whereIn('id',$article_ids)->fetchSql(false)->select();
        $article = static::with('tags')->limit($data['limit'])->page($data['page'])->fetchSql(false)->select();
        // var_dump($article);
        // exit;
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
            $res=self::get($article['id'])->tags()->saveAll(
                $data['tags_id']
            );
            if(!$res){
                throw new \Exception('新增文章失败');
            }
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
        // 启动事务
        Db::startTrans();
        try {
            $article = (new Article)->save($data,['id' => $data['id']]);
            $res=self::get($data['id'])->tags()->saveAll(
                $data['tags_id']
            );
            if(!$res){
                throw new \Exception('更新文章失败');
            }
            // 提交事务
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            throw new BaseException(
            [
                'msg' => '更新文章失败',
                'errorCode'=>1
            ]);
            Db::rollback();
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
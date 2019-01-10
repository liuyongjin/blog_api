<?php

namespace app\api\model;
use think\Model;
use app\lib\exception\BaseException;
use think\model\concern\SoftDelete;
class Article extends Model
{
    use SoftDelete;
    public static function getArticle($data)
    {
        $article = static::limit($data['limit'])->page($data['page'])->select();
        return $article;
    }
    public static function addArticle($data)
    {
        $article = self::create($data);
        if(!$article){
            throw new BaseException(
            [
                'msg' => '新增文章失败',
                'errorCode'=>1
            ]);
        }
        return $article;
    }
    public static function editArticle($data)
    {
        $article = self::save($data);
        if(!$article){
            throw new BaseException(
            [
                'msg' => '编辑文章失败',
                'errorCode'=>1
            ]);
        }
        return $article;
    }
    public static function delArticle($id)
    {
        $article = self::get($id)->delete();
        if(!$article){
            throw new BaseException(
            [
                'msg' => '删除文章失败',
                'errorCode'=>1
            ]);
        }
        return $article;
    }
}
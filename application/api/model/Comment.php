<?php

namespace app\api\model;
use think\Model;
use app\lib\exception\BaseException;
use think\model\concern\SoftDelete;
class Comment extends Model
{
    use SoftDelete;
    public static function getComment($data)
    {
        $comment = static::limit($data['limit'])->page($data['page'])->select();
        if(!$comment){
            throw new BaseException(
            [
                'msg' => '获取评论失败',
                'errorCode'=>1
            ]);
        }
        return $comment;
    }
    public static function addComment($data)
    {
        $comment = self::create($data);
        if(!$comment){
            throw new BaseException(
            [
                'msg' => '新增评论失败',
                'errorCode'=>1
            ]);
        }
    }
    public static function editComment($data)
    {
        $comment = self::save($data);
        if(!$comment){
            throw new BaseException(
            [
                'msg' => '编辑评论失败',
                'errorCode'=>1
            ]);
        }
    }
    public static function delComment($id)
    {
        $comment = self::get($id)->delete();
        if(!$comment){
            throw new BaseException(
            [
                'msg' => '删除评论失败',
                'errorCode'=>1
            ]);
        }
    }
    public static function bdelComment($ids)
    {
        $comment = self::get($ids)->delete();
        if(!$comment){
            throw new BaseException(
            [
                'msg' => '批量删除评论失败',
                'errorCode'=>1
            ]);
        }
    }
}
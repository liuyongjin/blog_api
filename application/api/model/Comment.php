<?php

namespace app\api\model;
use think\Model;
use app\lib\exception\BaseException;
use think\model\concern\SoftDelete;
use app\api\service\Token;
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
        $count = static::limit($data['limit'])->page($data['page'])->count();
        $res['data']=$comment;
        $res['total']=$count;
        return $res;
    }
    public static function addComment($data)
    {
        //获取当前的member_id
        $info=Token::verifyIdentity();
        if($info['auth']==='member'){
            $data['member_id']=$info['id'];
        }else{
            throw new BaseException([
                'msg' => '没有获取到前台用户id',
                'errorCode' => 999
            ]);
        }
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
        $comment =(new Comment)->save($data,['id' => $data['id']]);
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
        // $comment = self::get($ids)->delete();
        $comment =self::destroy($ids);
        if(!$comment){
            throw new BaseException(
            [
                'msg' => '批量删除评论失败',
                'errorCode'=>1
            ]);
        }
    }
}
<?php

namespace app\api\model;
use think\Model;
use app\lib\exception\BaseException;
use think\model\concern\SoftDelete;
class Tag extends Model
{
    use SoftDelete;
    public static function getTag($data)
    {
        $tag = static::limit($data['limit'])->page($data['page'])->select();
        if(!$tag){
            throw new BaseException(
            [
                'msg' => '获取标签失败',
                'errorCode'=>1
            ]);
        }
        return $tag;
    }
    public static function addTag($data)
    {
        $tag = self::create($data);
        if(!$tag){
            throw new BaseException(
            [
                'msg' => '新增标签失败',
                'errorCode'=>1
            ]);
        }
    }
    public static function editTag($data)
    {
        // $tag = self::update($data);
        $tag =(new Tag)->save($data,['id' => $data['id']]);
        if(!$tag){
            throw new BaseException(
            [
                'msg' => '编辑标签失败',
                'errorCode'=>1
            ]);
        }
    }
    public static function delTag($id)
    {
        $tag = self::get($id)->delete();
        if(!$tag){
            throw new BaseException(
            [
                'msg' => '删除标签失败',
                'errorCode'=>1
            ]);
        }
    }
    public static function bdelTag($ids)
    {
        $tag = self::destroy($ids);
        if(!$tag){
            throw new BaseException(
            [
                'msg' => '批量删除标签失败',
                'errorCode'=>1
            ]);
        }
    }
}
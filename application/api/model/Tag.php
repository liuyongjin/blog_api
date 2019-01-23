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
        $Tag = static::limit($data['limit'])->page($data['page'])->select();
        if(!$Tag){
            throw new BaseException(
            [
                'msg' => '获取标签失败',
                'errorCode'=>1
            ]);
        }
        return $Tag;
    }
    public static function addTag($data)
    {
        $Tag = self::create($data);
        if(!$Tag){
            throw new BaseException(
            [
                'msg' => '新增标签失败',
                'errorCode'=>1
            ]);
        }
    }
    public static function editTag($data)
    {
        $Tag = self::update($data);
        if(!$Tag){
            throw new BaseException(
            [
                'msg' => '编辑标签失败',
                'errorCode'=>1
            ]);
        }
    }
    public static function delTag($id)
    {
        $Tag = self::get($id)->delete();
        if(!$Tag){
            throw new BaseException(
            [
                'msg' => '删除标签失败',
                'errorCode'=>1
            ]);
        }
    }
    public static function bdelTag($ids)
    {
        $Tag = self::destroy($ids);
        if(!$Tag){
            throw new BaseException(
            [
                'msg' => '批量删除标签失败',
                'errorCode'=>1
            ]);
        }
    }
}
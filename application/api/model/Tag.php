<?php

namespace app\api\model;
use app\lib\exception\BaseException;
// use think\model\concern\SoftDelete;
use app\api\model\BaseModel;

class Tag extends BaseModel
{
    // use SoftDelete;
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
        $count = static::limit($data['limit'])->page($data['page'])->count();
        $res['data']=$tag;
        $res['total']=$count;
        return $res;
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
        // var_dump($ids);
        // var_dump($tag);
        // exit;
        if(!$tag){
            throw new BaseException(
            [
                'msg' => '批量删除标签失败',
                'errorCode'=>1
            ]);
        }
    }
}
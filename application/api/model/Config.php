<?php

namespace app\api\model;
use think\Model;
use app\lib\exception\BaseException;
use think\model\concern\SoftDelete;
class Config extends Model
{
    use SoftDelete;
    public static function getConfig($data)
    {
        $Config = static::limit($data['limit'])->page($data['page'])->select();
        if(!$Config){
            throw new BaseException(
            [
                'msg' => '获取配置失败',
                'errorCode'=>1
            ]);
        }
        return $Config;
    }
    public static function addConfig($data)
    {
        $Config = self::create($data);
        if(!$Config){
            throw new BaseException(
            [
                'msg' => '新增配置失败',
                'errorCode'=>1
            ]);
        }
    }
    public static function editConfig($data)
    {
        $Config = self::save($data);
        if(!$Config){
            throw new BaseException(
            [
                'msg' => '编辑配置失败',
                'errorCode'=>1
            ]);
        }
    }
    public static function delConfig($id)
    {
        $Config = self::get($id)->delete();
        if(!$Config){
            throw new BaseException(
            [
                'msg' => '删除配置失败',
                'errorCode'=>1
            ]);
        }
    }
}
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
        $config = static::limit($data['limit'])->page($data['page'])->select();
        if(!$config){
            throw new BaseException(
            [
                'msg' => '获取配置失败',
                'errorCode'=>1
            ]);
        }
        $count = static::limit($data['limit'])->page($data['page'])->count();
        $res['data']=$config;
        $res['total']=$count;
        return $config;
    }
    public static function addConfig($data)
    {
        //新增配置从配置中获取值config_app,100是front,200是wap,300是后台，默认取后台配置
        $data['config_dev']=config('my.config_dev');
        $data['config_app']=isset($data['config_app'])?$data['config_app']:config('my.config_admin_app');
        $config = self::create($data);
        if(!$config){
            throw new BaseException(
            [
                'msg' => '新增配置失败',
                'errorCode'=>1
            ]);
        }
    }
    public static function editConfig($data)
    {
        $data['config_dev']=config('my.config_dev');
        $data['config_app']=isset($data['config_app'])?$data['config_app']:config('my.config_admin_app');
        $config =(new Config)->save($data,['id' => $data['id']]);
        if(!$config){
            throw new BaseException(
            [
                'msg' => '编辑配置失败',
                'errorCode'=>1
            ]);
        }
    }
    public static function delConfig($id)
    {
        $config = self::get($id)->delete();
        if(!$config){
            throw new BaseException(
            [
                'msg' => '删除配置失败',
                'errorCode'=>1
            ]);
        }
    }
    public static function bdelConfig($ids)
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
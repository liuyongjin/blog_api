<?php

namespace app\api\model;
use think\Db;
use app\lib\exception\BaseException;
use app\api\model\BaseModel;

class Info extends BaseModel
{
    protected $hidden = ['delete_time'];

    public static function addInfo($data)
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

    public static function editInfo($data)
    {
        $info = Db::table('info')->where('ip','=',$data['ip'])->find();
        try{
          if(!$info){
            $info = self::create($data);
          }else{
            $data['update_time']=time();
            $info =Db::table('info')->where('ip','=',$data['ip'])->update($data);
          }
        }catch(\Exception $e){

          throw new BaseException(
            [
                'msg' => '更新信息失败',
                'errorCode'=>1
            ]);
        }

    }

}
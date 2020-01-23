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
        try {
            $resQuery=static::order('update_time','desc');
            $countQuery=new Tag();
            //既存在排序又存在搜索的时候
            if(isset($data['create_date'])&&count($data['create_date'])>0){
                $resQuery = $resQuery->where('create_time', 'between time', $data['create_date']);
                $countQuery = $countQuery->where('create_time', 'between time', $data['create_date']);
            }
            if(isset($data['sorter'])){
                $order=explode(" ", $data['sorter']);
                $order[1]=='ascend'?$order[1]='asc':$order[1]='desc';
                $resQuery = $resQuery->order($order[0],$order[1]);
            }
            $tag=$resQuery->limit($data['pageSize'])->page($data['current'])->select();
            $count=$countQuery->count();
            if(!$tag){
                throw new BaseException(
                [
                    'msg' => '获取标签失败',
                    'errorCode'=>1
                ]);
            }
            $res['data']=$tag;
            $res['total']=$count;
            $res['pageSize']=$data['pageSize'];
            $res['current']=$data['current'];
            return $res;
        } catch (\Exception $e) {
            throw new BaseException(
            [
                'msg' => '获取标签失败',
                'errorCode'=>1
            ]);
        }
    
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
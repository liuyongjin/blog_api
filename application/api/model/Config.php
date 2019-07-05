<?php

namespace app\api\model;
use app\lib\exception\BaseException;
use app\api\model\Article as ArticleModel;
use app\api\model\Tag as TagModel;
use app\api\model\BaseModel;

class Config extends BaseModel
{
    public static function getConfig()
    {
        self::updateValue();
        //从配置中获取值config_app,100是front,200是wap,300是后台，默认取后台配置
        $config = static::field('id,config_name,config_value,config_ext')->where('config_app','=',config('my.config_admin_app'))->order('id','asc')->select();
        if(!$config){
            throw new BaseException(
            [
                'msg' => '获取配置失败',
                'errorCode'=>1
            ]);
        }
        $count = static::where('config_app','=',config('my.config_admin_app'))->count();
        $res['data']=$config;
        $res['total']=$count;
        return $res;
    }
    //更新字段
    public static function updateValue(){
        $article_count=ArticleModel::count();
        $tag_count=TagModel::count();
        $visits=intval(ArticleModel::field('browse_count')->sum('browse_count'));
        $list = [
            ['id'=>1, 'config_value'=>$visits],
            ['id'=>2, 'config_value'=>$article_count],
            ['id'=>3, 'config_value'=>$tag_count]
        ];
        $config=new Config();
        $config->saveAll($list);
    }
}
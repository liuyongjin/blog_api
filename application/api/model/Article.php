<?php

namespace app\api\model;
// use think\Model;
use app\lib\exception\BaseException;
use app\api\model\BaseModel;
use think\Db;
use app\api\model\TagArticle;
// use think\model\concern\SoftDelete;
class Article extends BaseModel
{
    protected $hidden = ['tag_id','article_id','delete_time'];
    // use SoftDelete;
    // 定义多对多关系
    public function tags(){
        return $this->belongsToMany('tag','tag_article','tag_id','article_id');
    }

    public static function getPigeonhole(){
        $article_time=self::field('create_time')->where(['status'=>1])->order('create_time desc')->select()->toArray();
        $arr = array();
        foreach ($article_time as $k => $v) {
            $arr[] = date('Y-m',strtotime($v['create_time']));
        }
        //去掉相同的数组时间
        $arr = array_unique($arr);
        $article=[];
        //按时间排序文档
        foreach ($arr as $k => $v) {
            //每月第一天开始到下一个月第一天
            $start = date('Y-m-01', strtotime($v));
            $end = date("Y-m-d",strtotime("$start+1 month-1 day"));
            $limit_result = self::field('id,title,create_time')->where(['status'=>1])->whereTime('create_time','between',["$start","$end"])->order('create_time desc')->select()->toArray();
            //将时间存入数组
            $article[$v]=$limit_result;
        }
     
        $count=0;
        foreach ($article as $key => $value) {
            $count+=count($value);
        };
        $res['data']=$article;
        $res['total']=$count;
        return $res;
    }

    public static function getRandomList($data){
        $article=self::orderRaw('rand()')->limit($data['pageSize'])->where(['status'=>1])->select();
        if(!$article){
            throw new BaseException(
            [
                'msg' => '获取文章失败',
                'errorCode'=>1
            ]);
        }
        $count=self::count();
        $res['data']=$article;
        $res['total']=$count;
        return $res;
    }
    public static function getDetail($data){
        $article=self::with('tags')->field('id,title,des,content,comment_count,praise_count,browse_count,create_time,update_time')->where('id','=',$data['id'])->where(['status'=>1])->find();
        if(!$article){
            throw new BaseException(
            [
                'msg' => '获取文章详情失败',
                'errorCode'=>1
            ]);
        }
        $count=1;
        $res['data']=$article;
        $res['total']=$count;
        return $res;
    }
    public static function praiseInc($data){
        //给点赞量加一
        $article=self::where('id','=',$data['id'])->setInc('praise_count', 1);
        if(!$article){
            throw new BaseException(
            [
                'msg' => '操作失败!',
                'errorCode'=>1
            ]);
        }
        return [];
    }
    public static function browseInc($data){
        //给点赞量加一
        $article=self::where('id','=',$data['id'])->setInc('browse_count', 1);
        if(!$article){
            throw new BaseException(
            [
                'msg' => '操作失败!',
                'errorCode'=>1
            ]);
        }
        return [];
    }

    public static function searchArticleByTitleOrTag($data){
        $resQuery=new Article();
        $countQuery=new Article();
        if(isset($data['title'])){
            $resQuery=$resQuery->whereLike('title',"%{$data['title']}%");
            $countQuery = $countQuery->whereLike('title',"%{$data['title']}%");
        }
        if(isset($data['tag_id'])){
            $resQuery=$resQuery->alias('a')->field('a.id,a.title,a.status,a.des,a.main_img,a.content,a.comment_count,a.praise_count,a.browse_count,a.create_time,a.update_time')->join(['tag_article'=>'b'],'a.id = b.article_id')->where('b.tag_id','=',$data['tag_id']);
            $countQuery =  $countQuery->alias('a')->join(['tag_article'=>'b'],'a.id = b.article_id')->where('b.tag_id','=',$data['tag_id']);
        }
        $article=$resQuery->where(['status'=>1])->select();
        $count=$countQuery->where(['status'=>1])->count();
        if(!$article){
            throw new BaseException(
            [
                'msg' => '获取文章失败',
                'errorCode'=>1
            ]);
        }
        $res['data']=$article;
        $res['total']=$count;
        return $res;
    }

    public static function getArticle($data)
    {
        $resQuery=static::with('tags');
        $countQuery=new Article();
        //各种条件筛选
        if(isset($data['tags_id']) && count($data['tags_id'])>0){
            //貌似laravel这样写可以
            // $article = Article::with('tags')->whereHas('tags', function($query)use($data){
            //     $query->where('id',$data['tag_id']);
            // })->select();
            $resQuery=$resQuery->alias('a')->field('a.id,a.title,a.status,a.des,a.main_img,a.content,a.comment_count,a.praise_count,a.browse_count,a.create_time,a.update_time')->join(['tag_article'=>'b'],'a.id = b.article_id')->whereIn('b.tag_id',$data['tags_id']);
            $countQuery =  $countQuery->alias('a')->join(['tag_article'=>'b'],'a.id = b.article_id')->whereIn('b.tag_id',$data['tags_id']);
        }
        if(isset($data['title'])){
            $resQuery=$resQuery->whereLike('title',"%{$data['title']}%");
            $countQuery = $countQuery->whereLike('title',"%{$data['title']}%");
        }
        if(isset($data['status'])){
            $where=['status'=>$data['status']];
            $resQuery=$resQuery->where($where);
            $countQuery = $countQuery->where($where);
        }
        if(isset($data['create_date'])){
            if(isset($data['tags_id']) && count($data['tags_id'])>0){
                $field='a.create_time';
            }else{
                $field='create_time';
            }
            $resQuery=$resQuery->where($field, 'between time', $data['create_date']);
            $countQuery = $countQuery->where($field, 'between time', $data['create_date']);
        }
        if(isset($data['sorter'])){
            $order=explode(" ", $data['sorter']);
            $order[1]=='ascend'?$order[1]='asc':$order[1]='desc';
            //如果存在联合查询指定别名
            if(isset($data['tags_id']) && count($data['tags_id'])>0){
                $order[0]='a.'.$order[0];
            }
            $resQuery=$resQuery->order($order[0],$order[1]);
        }
        $article=$resQuery->limit($data['pageSize'])->page($data['current'])->fetchSql(false)->select();
        // var_dump($article);
        // exit;
        $count=$countQuery->count();
        if(!$article){
            throw new BaseException(
            [
                'msg' => '获取文章失败',
                'errorCode'=>1
            ]);
        }
        $res['data']=$article;
        $res['total']=$count;
        $res['pageSize']=$data['pageSize'];
        $res['current']=$data['current'];
        return $res;
    }
    public static function addArticle($data)
    {
        // 启动事务
        Db::startTrans();
        try {
            $article = self::create($data);
            $res=self::get($article['id'])->tags()->saveAll(
                $data['tags_id']
            );
            if(!$res){
                throw new \Exception('新增文章失败');
            }
            // 提交事务
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            throw new BaseException(
            [
                'msg' => '新增文章失败',
                'errorCode'=>1
            ]);
            Db::rollback();
        }
    }
    public static function editArticle($data)
    {
        // 启动事务
        Db::startTrans();
        try {
            $article = (new Article)->save($data,['id' => $data['id']]);
            //删除之前有关的标签(中间表采用真实删除)
            //软删除
            // $del=TagArticle::where('article_id','=',$data['id'])->update(['delete_time'=>time()]);
            //真删除
            $del=self::get($data['id'])->tags()->where('article_id','=',$data['id'])->detach();
            //新增标签
            $res=self::get($data['id'])->tags()->saveAll(
                $data['tags_id']
            );
          
            if(!$res){
                throw new BaseException(
                [
                    'msg' => '更新文章失败',
                    'errorCode'=>1
                ]);
            }
            // 提交事务
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            throw new BaseException(
            [
                'msg' => '更新文章失败',
                'errorCode'=>1
            ]);
            Db::rollback();
        }
    }
    public static function updateArticleStatus($data){
        $res=Article::where('id', $data['id'])->update(['status' => $data['status']]);
        if(!$res){
            throw new BaseException(
            [
                'msg' => '更新文章状态失败',
                'errorCode'=>1
            ]);
        }
    }
    public static function delArticle($id)
    {
        // $article = self::get($id)->delete();
        $article = self::destroy($id);
        if(!$article){
            throw new BaseException(
            [
                'msg' => '删除文章失败',
                'errorCode'=>1
            ]);
        }
    }
    public static function bdelArticle($ids)
    {
        $article =self::destroy($ids);
        if(!$article){
            throw new BaseException(
            [
                'msg' => '批量删除文章失败',
                'errorCode'=>1
            ]);
        }
    }
}
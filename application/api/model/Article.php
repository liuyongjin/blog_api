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

    public static function getArticle($data)
    {
        $resQuery=static::with('tags')->order('update_time','desc');
        $countQuery=new Article();
        //各种条件筛选
        if(isset($data['tags_id'])){
            //貌似laravel这样写可以
            // $article = Article::with('tags')->whereHas('tags', function($query)use($data){
            //     $query->where('id',$data['tag_id']);
            // })->select();
            $resQuery=$resQuery->alias('a')->join(['tag_article'=>'b'],'a.id = b.article_id')->whereIn('b.tag_id',$data['tags_id']);
            $countQuery =  $countQuery::alias('a')->join(['tag_article'=>'b'],'a.id = b.article_id')->whereIn('b.tag_id',$data['tags_id']);
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
            if(isset($data['tags_id'])){
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
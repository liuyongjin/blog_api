<?php

namespace app\api\model;
use think\Model;
use app\lib\exception\BaseException;
use think\model\concern\SoftDelete;
use app\api\service\Token as TokenService;

class Member extends Model
{
    use SoftDelete;
    public static function getMember($data)
    {
        $member = static::limit($data['limit'])->page($data['page'])->select();
        if(!$member){
            throw new BaseException(
            [
                'msg' => '获取会员失败',
                'errorCode'=>1
            ]);
        }
        $count = static::limit($data['limit'])->page($data['page'])->count();
        $res['data']=$member;
        $res['total']=$count;
        return $res;
    }
    public static function addMember($data)
    {
        $member = self::where('username','=',$data['username'])->find();
        if($member){
            throw new BaseException(
            [
                'msg' => '用户名已经存在',
                'errorCode'=>1
            ]);
        }
        $data['password']=encryption($data['password']);
        $res=self::create($data);
        if(!$res){
            throw new BaseException(
            [
                'msg' => '新增会员失败',
                'errorCode'=>1
            ]);
        }
    }
    public static function editMember($data)
    {
        //判断用户名是否已经存在
        $where=[
            'username'=>$data['username']
        ];
        $member = Member::where($where)->find();
        if($member){
            throw new BaseException(
            [
                'msg' => '用户名已经存在',
                'errorCode'=>1
            ]);
        }
        //更新信息
        $data['password']=isset($data['password'])?encryption($data['password']):'';
        // $member = self::update($data);
        $res =(new Member)->save($data,['id' => $data['id']]);
        if(!$res){
            throw new BaseException(
            [
                'msg' => '编辑会员失败',
                'errorCode'=>1
            ]);
        }
    }
    public static function delMember($id)
    {
        $member = self::get($id)->delete();
        if(!$member){
            throw new BaseException(
            [
                'msg' => '删除会员失败',
                'errorCode'=>1
            ]);
        }
    }
    public static function bdelMember($ids)
    {
        $member = self::destroy($ids);
        if(!$member){
            throw new BaseException(
            [
                'msg' => '批量删除会员失败',
                'errorCode'=>1
            ]);
        }
    }

    public static function logoutMember(){
        $token = request()->header('token');
        $res=cache($token,null);
        return $res;
    }

    public static function loginMember($data)
    {
        $member = Member::where('username','=',$data['username'])->find();
        if(!$member){
            throw new BaseException(
            [
                'msg' => '用户不存在',
                'errorCode'=>1
            ]);
        }else if($member['password']!==encryption($data['password'])){
            throw new BaseException(
            [
                'msg' => '密码错误',
                'errorCode'=>1
            ]);
        }else{
            $token=TokenService::generateToken();
            //更新token和Ip信息and地址信息
            $ip=request()->ip();
            (new Member)->save([
                'token'=>$token,
                'last_login_ip'=>$ip,
                'last_login_time'=>time()
            ],
                ['username'=>$data['username']
            ]
            );
            $expire_in = config('my.token_expire_in');
            $info['id']=$member['id'];
            //user表的用户才能操作后台接口
            $info['auth']='member';
            // var_dump(cache($token, $info, $expire_in));
            // exit;
            if(!cache($token, $info, $expire_in)){
                throw new BaseException([
                    'msg' => '服务器缓存异常',
                    'errorCode' => 10005
                ]);
            }
            return $token;
        }
    }
}
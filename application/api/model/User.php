<?php

namespace app\api\model;
use think\Model;
use app\lib\exception\BaseException;
use app\api\service\Token as TokenService;

class User extends Model
{
    public static function loginUser($data)
    {
        $user = User::where('username','=',$data['username'])->find();
        if(!$user){
            throw new BaseException(
            [
                'msg' => '用户不存在',
                'errorCode'=>1
            ]);
        }else if($user['password']!==encryption($data['password'])){
            throw new BaseException(
            [
                'msg' => '密码错误',
                'errorCode'=>1
            ]);
        }else{
            $token=TokenService::generateToken();
            //更新token和Ip信息and地址信息
            $ip=request()->ip();
            (new User)->save([
                'token'=>$token,
                'last_login_ip'=>$ip,
                'last_login_time'=>time()
                // 'update_time'=>time()
            ],
                ['username'=>$data['username']
            ]
            );
            $expire_in = config('my.token_expire_in');
            $info['id']=$user['id'];
            //user表的用户才能操作后台接口
            $info['auth']='user';
            if(!cache($token, $info, $expire_in)){
                throw new BaseException([
                    'msg' => '服务器缓存异常',
                    'errorCode' => 10005
                ]);
            }
            return $token;
        }
    }
    public static function registerUser($data){
        $user = User::where('username','=',$data['username'])->find();
        if($user){
            throw new BaseException(
            [
                'msg' => '用户名已经存在',
                'errorCode'=>1
            ]);
        }
        $data['password']=encryption($data['password']);
        $res=User::create($data);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    public static function logoutUser(){
        $token=request()->header('token');
        $res=cache($token,null);
        return $res;
    }
    public static function modifyUser($data){
        $token=request()->header('token');
        //判断用户名是否已经存在
        $where=[
            'username'=>$data['username'],
            'token'=>$token
        ];
        $user = User::where($where)->find();
        if($user){
            throw new BaseException(
            [
                'msg' => '用户名已经存在',
                'errorCode'=>1
            ]);
        }
        //更新信息
        $data['password']=encryption($data['password']);
        $res=(new User)->save(
        $data,
            [
                'token'=>$token
            ]
        );
        return $res;
    }
}
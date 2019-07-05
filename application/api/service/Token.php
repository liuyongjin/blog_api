<?php

namespace app\api\service;
use think\Exception;
use app\lib\exception\BaseException;

class Token
{
    // 生成令牌
    public static function generateToken()
    {
        $randChar = getRandChar(32);
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        $tokenSalt = config('my.token_salt');
        // return hash('md5',md5($randChar . $timestamp . $tokenSalt));
        return md5($randChar . $timestamp . $tokenSalt);
    }
    //验证token是否合法或者是否过期
    //验证器验证只是token验证的一种方式
    //另外一种方式是使用行为拦截token，根本不让非法token
    //进入控制器
    public static function needPrimaryScope()
    {
        $scope = self::getCurrentTokenVar('scope');
    }
    public static function getCurrentTokenVar($key='')
    {
        $token = request()->header('token');
        if(!$token){
            $exception = new BaseException(
                [
                    'msg' => '请输入token',
                    'errorCode'=>999
                ]);
            throw $exception;
        }
        $vars = cache($token);
        // var_dump($vars);
        // exit;
        if (!$vars)
        {
            $exception = new BaseException(
                [
                    'msg' => 'Token已过期或无效Token',
                    'errorCode'=>999
                ]);
            throw $exception;
        }else{
            if($vars['auth']!=='user'){
                $exception = new BaseException(
                    [
                        'msg' => '不是后台用户，无法操作后台',
                        'errorCode'=>999
                    ]);
                throw $exception;
            }
        }
        return $vars;
    }
    // public static function verifyIdentity()
    // {
    //     $token = request()->header('token');
    //     if(!$token){
    //         $exception = new BaseException(
    //             [
    //                 'msg' => '请输入token',
    //                 'errorCode'=>999
    //             ]);
    //         throw $exception;
    //     }
    //     $vars = cache($token);
    //     if (!$vars)
    //     {
    //         $exception = new BaseException(
    //             [
    //                 'msg' => 'Token已过期或无效Token',
    //                 'errorCode'=>999
    //             ]);
    //         throw $exception;
    //     }else{
    //         if($vars['auth']!=='member'){
    //             $exception = new BaseException(
    //                 [
    //                     'msg' => '不是会员用户',
    //                     'errorCode'=>999
    //                 ]);
    //             throw $exception;
    //         }
    //     }
    //     return $vars;
    // }
}
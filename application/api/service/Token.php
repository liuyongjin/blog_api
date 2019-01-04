<?php

namespace app\api\service;
use think\Exception;

class Token
{
    // 生成令牌
    public static function generateToken()
    {
        $randChar = getRandChar(32);
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        $tokenSalt = config('my.token_salt');
        return md5($randChar . $timestamp . $tokenSalt);
    }
}
<?php

namespace app\api\model;
use think\Model;

class User extends Model
{
    public static function getUser()
    {
        $user = User::select();
        return $user;
    }
}
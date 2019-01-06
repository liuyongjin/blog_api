<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('test', 'index/index/index');
Route::group('api/:version',function(){
   //登录
    Route::post('login', 'api/:version.User/login');
    //退出登录
    Route::post('logout', 'api/:version.User/logout');
    //注册
    Route::post('register', 'api/:version.User/register');
    //修改个人信息
    Route::post('modifyInfo', 'api/:version.User/modifyInfo');
});


// return [

// ];

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

// Route::get('test', 'index/index/index');
Route::group('api/:version',function(){
   //登录
    Route::post('login', 'api/:version.User/login');
    //退出登录
    Route::post('logout', 'api/:version.User/logout');
    //注册
    Route::post('register', 'api/:version.User/register');
    //修改个人信息
    Route::post('modifyInfo', 'api/:version.User/modifyInfo');
    //文章列表
    Route::any('article/list', 'api/:version.Article/index');
    //新增文章
    Route::post('article/add', 'api/:version.Article/add');
    //编辑文章
    Route::post('article/edit', 'api/:version.Article/edit');
    //删除文章
    Route::post('article/del', 'api/:version.Article/del');
    //批量删除文章
    Route::post('article/bdel', 'api/:version.Article/bdel');
    //评论列表
    Route::post('comment/list', 'api/:version.Comment/list');
    //新增评论
    Route::post('comment/add', 'api/:version.Comment/add');
    //编辑评论
    Route::post('comment/edit', 'api/:version.Comment/edit');
    //删除评论
    Route::post('comment/del', 'api/:version.Comment/del');
    //批量删除评论
    Route::post('comment/bdel', 'api/:version.Comment/bdel');
});


// return [

// ];

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

Route::group('api/:version',function(){
    //上传图片
    Route::post('upload', 'api/:version.Upload/upload');
   //登录
    Route::post('login', 'api/:version.User/login');
    //退出登录
    Route::post('logout', 'api/:version.User/logout');
    //注册（不开放注册接口）
    // Route::post('register', 'api/:version.User/register');
    //获取个人信息
    Route::get('currentUser', 'api/:version.User/currentUser');
    //修改个人信息
    Route::post('modifyInfo', 'api/:version.User/modifyInfo');
    //修改个人头像
    Route::post('modifyAvatar', 'api/:version.User/modifyAvatar');
    //文章列表
    Route::post('article/index', 'api/:version.Article/index');
    //搜索文章
    Route::post('article/searchArticle', 'api/:version.Article/searchArticle');
    //归档文章列表
    Route::post('article/pigeonholeList', 'api/:version.Article/pigeonholeList');
    //获取随机文章
    Route::post('article/randomList', 'api/:version.Article/randomList');
    //获取文章详情
    Route::post('article/detail', 'api/:version.Article/detail');
    //点赞
    Route::post('article/praise', 'api/:version.Article/praise');
    //浏览量加一
    Route::post('article/browse', 'api/:version.Article/browse');
    //新增文章
    Route::post('article/add', 'api/:version.Article/add');
    //编辑文章
    Route::post('article/edit', 'api/:version.Article/edit');
    //更新文章状态
    Route::post('article/updateStatus', 'api/:version.Article/updateStatus');
    //删除文章
    Route::post('article/del', 'api/:version.Article/del');
    //批量删除文章
    Route::post('article/bdel', 'api/:version.Article/bdel');
    //评论列表
    Route::post('comment/index', 'api/:version.Comment/index');
    //新增评论
    Route::post('comment/add', 'api/:version.Comment/add');
    //编辑评论
    Route::post('comment/edit', 'api/:version.Comment/edit');
    //删除评论
    Route::post('comment/del', 'api/:version.Comment/del');
    //批量删除评论
    Route::post('comment/bdel', 'api/:version.Comment/bdel');
    //标签列表
    Route::post('tag/index', 'api/:version.Tag/index');
    //新增标签
    Route::post('tag/add', 'api/:version.Tag/add');
    //编辑标签
    Route::post('tag/edit', 'api/:version.Tag/edit');
    //删除标签
    Route::post('tag/del', 'api/:version.Tag/del');
    //批量删除标签
    Route::post('tag/bdel', 'api/:version.Tag/bdel');
    //配置列表
    Route::post('config/index', 'api/:version.Config/index');
});
// Route::get('test', 'index/index/index');


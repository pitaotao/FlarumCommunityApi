<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2018/11/19
 * Time: 17:54
 */

//获取分类
Route::get('api/category', 'CategoryController/getAllCategory')
    ->header('Access-Control-Allow-Origin','http://localhost:8080')
    ->header('Access-Control-Allow-Credentials', 'true')
    ->allowCrossDomain(true);

//获取文章信息
Route::get('api/article','ArticleController/getAllArticle')
    ->header('Access-Control-Allow-Origin','http://localhost:8080')
    ->header('Access-Control-Allow-Credentials', 'true')
    ->allowCrossDomain(true);

//接收注册信息
Route::post('/sendRegisterInfo','UserController/addUser')
    ->header('Access-Control-Allow-Origin','http://localhost:8080')
    ->header('Access-Control-Allow-Credentials', 'true')
    ->allowCrossDomain(true);

//接收登录信息
Route::post('/sendLoginInfo','UserController/doLogin')
    ->header('Access-Control-Allow-Origin','http://localhost:8080')
    ->header('Access-Control-Allow-Credentials', 'true')
    ->allowCrossDomain(true);

//接收添加话题信息
Route::post('/sendTopicInfo','ArticleController/addTopic')
    ->header('Access-Control-Allow-Origin','http://localhost:8080')
    ->header('Access-Control-Allow-Credentials', 'true')
    ->allowCrossDomain(true);


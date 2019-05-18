<?php
use think\Route;
//登陆
Route::post("user/login", "index/user/login");
//登出
Route::post("user/lout", "index/user/loginOut");
//是否登陆
Route::post("user/isLogin", "index/user/isLogin");
//修改密码
Route::post("user/edit", "index/user/editPwd");
//新增文章分类（大类）
Route::post("cate/add", "index/category/addCategory");
//新增文章分类（小类）
Route::post("cate/add_s", "index/category/addCategory_s");
//获取文章大类
Route::post("cate/get_c", "index/category/getCategory");
//获取文章小类
Route::post("cate/get_d", "index/category/getCategory_d");
// 获取大类and小类(nav)
Route::post("cate/get_cs", "index/category/getCategory_s");
//新增文章
Route::post("article/add", "index/article/add");
//修改文章
Route::post("article/edit", "index/article/edit");
//获取文章列表
Route::post('article/list', "index/article/list");
//获取单个文章
Route::post('article/getOne', 'index/article/getOne');
//删除文章
Route::post("article/del", "index/article/del");
//获得首页文章列表的信息
Route::post('article/get_list', 'index/article/get_list');
//获得文章详情信息
Route::post('article/get_detail', 'index/article/get_detail');
//根据category_id来获取文章
Route::post('article/get_category', 'index/article/get_category');
//查询文章
// Route::post("editPwd", "index/article/editPwd");
//新增标签
Route::post("tag/addTag", "index/tag/addTag");

Route::get("tag/get", "index/Tag/get");

//
Route::post("weather", "index/index/getWeater");

//获取ip地址和地理地址
Route::post('index/location', 'index/index/getLocation');

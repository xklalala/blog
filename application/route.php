<?php
use think\Route;
//登陆
Route::post("user/login", "index/user/login");
//登出
Route::get("user/lout", "index/user/loginOut");
//修改密码
Route::post("user/edit", "index/user/editPwd");
//新增文章分类（大类）
Route::post("cate/add", "index/category/addCategory");
//新增文章分类（小类）
Route::post("cate/add_s", "index/category/addCategory_s");
//获取文章大类
Route::post("cate/get_c", "index/category/getCategory");
// 获取大类and小类(nav)
Route::post("cate/get_cs", "index/category/getCategory_s");
//新增文章
Route::post("article/add", "index/article/add");
//修改文章
Route::post("article/edit", "index/article/edit");
//删除文章
// Route::post("editPwd", "index/article/editPwd");
//查询文章
// Route::post("editPwd", "index/article/editPwd");
//新增标签
Route::post("tag/addTag", "index/tag/addTag");

//
Route::get("weather", "index/index/getWeater");
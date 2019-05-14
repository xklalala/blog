<?php
namespace app\index\controller;
use think\Session;
class Base {
	public function __construct() {
		if(strlen(Session::get('id'))==0)
		{
			echo json_encode(['message'=>'身份过期，请重新登录', 'code'=>0]);
			exit;
		}
		header('Access-Control-Allow-Origin:*');
	}
}
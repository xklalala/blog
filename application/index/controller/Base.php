<?php
namespace app\index\controller;
use think\Cache;
use app\common\tools\Rds;
class Base {
	public function __construct() {
		
		header('Access-Control-Allow-Origin:*');
	}

	public static function isLogin(){
		$redis = Rds::getRds();

		if($redis->get('id'.$_POST['userId']) != $_POST['userId'])
		{
			echo json_encode(['message'=>'身份过期，请重新登录', 'code'=>0]);
			exit;
		}
	}


}
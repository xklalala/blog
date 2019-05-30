<?php
namespace app\index\controller;
use app\common\tools\RM;
use app\common\tools\XV;
use app\index\model\common;
class Commons{
	public function __construct(){
		header('Access-Control-Allow-Origin:*');
	}
	public function put(){
		XV::v(['article_id', 'content'=>['len'=>3, 'name'=>'评论长度', 'ban'=>['script','圾']]]);
		$_POST['time'] = date('Y-m-d H:i:s');
		$_POST['ip'] = $ip = $_SERVER['REMOTE_ADDR'];
		$location = (new Index())->getLocation(true);
		$_POST['location'] = $location;
		$common = new common($_POST);
		$status = $common->save();
		RM::r($status);
	}

	public function get(){
		XV::v(['article_id'=>['len'=>1]]);
		$data = common::all(['article_id'=>$_POST['article_id']])->toArray();
		RM::r($data);
	}
}
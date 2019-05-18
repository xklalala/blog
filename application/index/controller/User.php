<?php
namespace app\index\controller;
use app\index\model\b_user;
use think\Cache;
use app\common\tools\Rds;

class User {
	protected $redis;
	public function __construct(){
		header('Access-Control-Allow-Origin:*');
		$this->redis = Rds::getRds();
	}
	//判断用户名和密码是否正确
	//$login false登陆， true修改密码
	private function check($login = false) {
		$json = ['message' => '', 'code' => 0];
		if (isset($_POST['name']) && isset($_POST['password'])) {
			//数据库中查询记录是否存在
			$data = b_user::get(['name' => $_POST['name']]);

			//如果不存在
			if (!$data) {
				$json['message'] = '用户名不存在';
				return $json;
			}
			//判断密码是否正确
			if ($data->password == $_POST['password']) {
				$json['message'] = 'success';
				$json['code'] = 1;
				$json['data'] = ['userId' => $data->id];

				//如果是登陆功能
				if (!$login) {
					$this->redis->set(['id'.$data->id=>$data->id], 1800);
					$this->redis->set(['name'.$data->id=>$data->name], 1800);
					// $this->isLogin();
				}
			} else {
				$json['message'] = '密码错误';
			}
		} else {
			$json['message'] = '用户名或者密码为空';
		}

		return $json;
	}
	//登陆接口
	//参数 name pwd
	public function login() {
		echo json_encode($this->check());
	}

	//退出
	public function loginOut() {
		XS::clear();
		echo json("success", 1);
		return;
	}

	//修改密码
	//参数 name password newpassword
	public function editPwd() {
		$status = $this->check(true);

		if ($status['code'] == 1) {
			//如果信息都正确，那么修改密码
			$user = b_user::get(['name' => $_POST['name']]);
			$user->password = $_POST['newpassword'];
			$code = $user->save();

			if ($code != 1) {
				$status['message'] = 'error';
				$status['code'] = 0;
			}
		}
		return json_encode($status);
	}

	public function isLogin(){
		if(isset($_POST['userId']))
			if($this->redis->get('id'.$_POST['userId']) != $_POST['userId']){
				echo json_encode(['message'=>'不在线', 'code'=>0]);
			}else
				echo json_encode(['message'=>'在线', 'code'=>1]);
	}

}
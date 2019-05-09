<?php
namespace app\index\controller;
use app\index\model\b_user;
use think\Session;

class User extends Base
{
	//判断用户名和密码是否正确
    //$login false登陆， true修改密码
    private function check($login=false)
    {
    	$json = ['message'=>'', 'code'=>0];
    	if(isset($_POST['name']) && isset($_POST['password']))
    	{
    		//数据库中查询记录是否存在
			$data = b_user::get(['name'=>$_POST['name']]);

			//如果不存在
			if(!$data)
			{
				$json['message'] = 'user is not exit';
				return $json;
			}
			//判断密码是否正确
			if($data->password == $_POST['password']){
				$json['message'] = 'success';
				$json['code'] = 1;

				//如果是登陆功能
				if(!$login)
				{
                    Session::set('id', $data->id);
                    Session::set('name', $data->name);
				}
			}
			else{
				$json['message'] = 'password is error';
			}
    	}
    	else
    		$json['message'] = 'username or password is empty';
    		
    	return $json;
    }
    //登陆接口
    //参数 name pwd
    public function login()
    {
    	echo json_encode($this->check());
    }

    //退出
    public function loginOut()
    {
    	$_SESSION = null;
    	echo json("success", 1);
    	return;
    }

    //修改密码
    //参数 name password newpassword
    public function editPwd()
    {
    	$status = $this->check(true);

    	if($status['code']==1)
    	{
    		//如果信息都正确，那么修改密码
    		$user = b_user::get(['name'=>$_POST['name']]);
    		$user->password = $_POST['newpassword'];
    		$code = $user->save();

    		if($code!=1)
    		{
    			$status['message'] = 'error';
    			$status['code'] = 0;
    		}
    	}
    	return json_encode($status);
    }

}
<?php
namespace app\index\controller;
use app\index\model\b_article;
use think\Session;

//验证器后面加上去吧2019.5.9
class Article extends Base
{
	private static $b_article;

	public function __construct()
	{
		self::$b_article = new b_article();
	}


	//添加文章
	public function add()
	{
		$json = ['message'=>'error', 'code'=>0];
		if(
			isset($_POST['title'])   && strlen(trim($_POST['title']))>0   && 
			isset($_POST['content']) && strlen(trim($_POST['content']))>0 && 
			isset($_POST['c_id'])    && strlen(trim($_POST['c_id']))>0   && 
			isset($_POST['c_title'])  && strlen(trim($_POST['c_title']))>0  && 
			isset($_POST['t_id']))
		{
			$model = self::$b_article;
			$model->title = $_POST['title'];
			$model->content = $_POST['content'];
			$model->c_time = time();
			$model->u_id = Session::get('id');
			$model->u_name = Session::get('name');
			$model->hit = 0;
			$model->c_id = $_POST['c_id'];
			$model->c_title = $_POST['c_title'];
			$model->t_id = $_POST['t_id'];
			$s = $model->save();
			if($s == 1){
				$json['message'] = 'success';
				$json['code'] = 1;
			}
		}
		echo json_encode($json);
		return;
	}

	public function add()
	{
		$json = ['message'=>'error', 'code'=>0];
		if(
			isset($_POST['title'])   && strlen(trim($_POST['title']))>0   && 
			isset($_POST['content']) && strlen(trim($_POST['content']))>0 && 
			isset($_POST['c_id'])    && strlen(trim($_POST['c_id']))>0   && 
			isset($_POST['c_title'])  && strlen(trim($_POST['c_title']))>0  && 
			isset($_POST['t_id']))
		{
			
		}

	}
}
<?php
namespace app\index\controller;
use app\index\model\b_article;
use think\Db;
use think\Session;
use app\index\model\common;
use app\index\model\b_category;
use app\common\tools\Rds;
//验证器后面加上去吧2019.5.9
class Article{
	protected $redis;

	private static $b_article;

	public function __construct() {
		header('Access-Control-Allow-Origin:*');
		$this->redis = Rds::getRds();
		self::$b_article = new b_article();
		
	}

	//添加文章
	public function add() {
		Base::isLogin();

		// echo json_encode($_POST);
		// return;
		$json = ['message' => 'error', 'code' => 0];
		if (
			isset($_POST['title']) && strlen(trim($_POST['title'])) > 0 &&
			isset($_POST['content']) && strlen(trim($_POST['content'])) > 0 &&
			isset($_POST['c_id']) && strlen(trim($_POST['c_id'])) > 0 &&
			isset($_POST['userId'])&&
			isset($_POST['t_id'])) {
			$arr = explode(',', $_POST['c_id']);
			$model = self::$b_article;
			$model->title = $_POST['title'];
			$model->content = $_POST['content'];
			$model->c_time = time();
			$model->u_id = $this->redis->get('id'.$_POST['userId']);
			$model->u_name = $this->redis->get('name'.$_POST['userId']);
			$model->hit = 0;
			$model->c_id = $arr[0];
			$model->c_title = $arr[1];
			$model->t_id = $_POST['t_id'];
			$s = $model->save();
			if ($s == 1) {
				$json['message'] = 'success';
				$json['code'] = 1;
			}
		}
		echo json_encode($json);
		return;
	}


	public function del() {
		if (isset($_POST['id']) && strlen(trim($_POST['id'])) != 0) {
			$status = b_article::get($_POST['id']);
		}

		$status->status = 0;
		$status->save();
		if ($status) {
			echo json_encode(['message' => '删除成功', 'code' => 1]);
		} else {
			echo json_encode(['message' => '发生错误，请稍后重试', 'code' => 0]);
		}

	}
	public function getOne() {
		if (isset($_POST['id']) && strlen(trim($_POST['id']))) {
			$data = b_article::get($_POST['id'])->toArray();
			echo json_encode(['message' => 'success', 'code' => 1, 'data' => $data]);
			return;
		}
		echo json_encode(['message' => '发生错误', 'code' => 0]);
	}

	public function edit() {
		$json = ['message' => 'error', 'code' => 0];
		if (
			isset($_POST['title']) && strlen(trim($_POST['title'])) > 0 &&
			isset($_POST['content']) && strlen(trim($_POST['content'])) > 0 &&
			isset($_POST['c_id']) && strlen(trim($_POST['c_id'])) > 0 &&
			isset($_POST['id']) && strlen(trim($_POST['id'])) > 0 &&
			isset($_POST['t_id'])) {
			$arr = explode(',', $_POST['c_id']);
			$model = b_article::get($_POST['id']);
			$model->title = $_POST['title'];
			$model->content = $_POST['content'];
			$model->e_time = time();
			$model->u_id = Session::get('id');
			$model->u_name = Session::get('name');
			$model->c_id = $arr[0];
			$model->c_title = $arr[1];
			$model->t_id = $_POST['t_id'];
			$s = $model->save();
			if ($s == 1) {
				$json['message'] = 'success';
				$json['code'] = 1;
			}
		}
		echo json_encode($json);
		return;
	}
	public function list() {
		$data = Db('b_article')->where(['status' => 1])->field('id, title, c_title, c_time, hit')->select();
		// var_dump($data);
		echo json_encode(['message' => 'success', 'code' => 1, 'data' => $data]);
	}
//===================

	//获得首页用户信息
	function get_list(){
		header('Access-Control-Allow-Origin:*');
		//获得文章评论总量
		$tag = new Tag();
		$tag = $tag->get_list();
		$common = Db::table('common')->field('article_id, count(article_id) as num')->group('article_id')->select();
		$data = Db('b_article')->where(['status' => 1])->field('id, title, u_name,hit, c_id, c_title, t_id, c_time')->order('c_time desc')->select();

		foreach($data as $k=>$v){
			foreach($common as $key=>$value){
				if($v['id']==$value['article_id'])
				{
					$data[$k]['common_num'] = $value['num'];
				}
				else
					$data[$k]['common_num'] = 0;
				$data[$k]['c_time'] = date('Y-m-d', $v['c_time']);
				$data[$k]['t_id'] = $this->get_tag($tag, $v['t_id']);
			}
		}
		echo json_encode(['message'=>'success', 'code'=>1, 'data'=>$data]);
	}

	private function get_tag($tag=[], $strs){
		if(strlen($strs) == 0)
			return "无";
		$len = strlen($strs);
		$str = "";
		if(count($tag)>0)
			for($i=0; $i<$len; $i++){
				$str .= ",".$tag[$strs[$i]];
			}
		return ltrim($str, ',');
	}

	public function get_detail(){
		if(isset($_POST['id']) && strlen(trim($_POST['id']))>0){
			$tag = new Tag();
			$tag = $tag->get_list();

			$data = b_article::get($_POST['id'])->toArray();
			Db::table('b_article')->where(['id'=>$_POST['id']])->setInc('hit');
			$data['c_time'] = date('Y-m-d H:i:s', $data['c_time']);
			$data['t_id'] = $this->get_tag($tag, $data['t_id']);
			echo json_encode(['message'=>'success', 'code'=>1, 'data'=>$data]);
		}else{
			echo json_encode(['message'=>'error', 'code'=>0]);
		}
	}

	public function get_category()
	{
		//pid=0
		if(isset($_POST['id'])  && isset($_POST['type']) && strlen(trim($_POST['type'])))
		{
			if($_POST['type'] == 'main_id')
			{
				$c_id = b_category::all(['pid'=>$_POST['id']]);
				$pid = [];
				foreach ($c_id as $key => $value) {
					$pid[] = $value->id;
				}
				
			}
			else if($_POST['type'] == 'c_id')
			{
				$pid = [$_POST['id']];
			}
			//查询相关文章
				$tag = new Tag();
				$tag = $tag->get_list();
				$common = Db::table('common')->field('article_id, count(article_id) as num')->group('article_id')->select();
				$data = Db('b_article')->where('c_id', 'in', $pid)->field('id, title, u_name,hit, c_id, c_title, t_id, c_time')->select();

				foreach($data as $k=>$v){
					foreach($common as $key=>$value){
						if($v['id']==$value['article_id'])
						{
							$data[$k]['common_num'] = $value['num'];
						}
						else
							$data[$k]['common_num'] = 0;
						$data[$k]['c_time'] = date('Y-m-d', $v['c_time']);
						$data[$k]['t_id'] = $this->get_tag($tag, $v['t_id']);
					}
				}
				echo json_encode(['message'=>'success', 'code'=>1, 'data'=>$data]);
			
		}
		
	}
}
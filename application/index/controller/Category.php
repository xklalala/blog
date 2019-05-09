<?php
namespace app\index\controller;
use app\index\controller\base;
use app\index\model\b_category;

class Category extends Base
{
	private static $b_category;

	public function __construct()
	{
		self::$b_category = new b_category();
	}

	//新增文章分类（大类）
    public function addCategory()
    {
    	$json = ['message'=>'error', 'code'=>0];

    	if(isset($_POST['name']) && strlen($_POST['name'])>0)
    	{
    		$data = b_category::get(['name'=>$_POST['name']]);

    		//如果没有查询到
    		if(!$data)
    		{
    			$model = self::$b_category;
    			$model->data(['pid'=>0, 'name'=>$_POST['name']]);
    			$s = $model->save();

    			//如果保存成功
    			if($s == 1){
    				$json['message'] = 'success';
    				$json['code'] = 1;
    			}
    		}
    		else
    			$json['message'] = 'the category aready exist';
    	}
    	echo json_encode($json);
    	return;
    }

    //获取所有的主分类
    public function getCategory()
    {
    	$res = b_category::all(['pid'=>0]);

    	$data = null;
    	foreach($res as $k=>$v)
    		$data[] = ['id'=>$v->id, 'name'=>$v->name];

    	if($data != null)
    		echo jsons($data, 'success', 1);
    	else
    		echo json('error');

    	return;
    }

    //获取大小分类（nav）
    public function getCategory_s()
    {
    	//分别获取大类，小类的数据
    	$res1 = b_category::all(['pid'=>0]);
    	$res2 = b_category::all(function($query){
    		$query->where('pid','>',0);
    	});

    	$data = null;
    	//循环将小类放到大类下面
    	foreach($res1 as $value)
    	{
    		$c_data = null;
    		foreach($res2 as $k=> $v)
    		{
    			if($value->id == $v->pid)
    			{
    				$c_data[] = $v->name;
    				unset($res2[$k]);
    			}
    		}

    		$data[] = [
    			"title"=>$value->name,
    			"c_title"=>$c_data
    		];
    	}
    	if($data != null)
    		echo jsons($data, 'success', 1);
    	else
    		echo json('no data');
    }


    //添加文章类型小类
    //参数 大类id c_id
    public function addCategory_s()
    {
    	$json = ['message'=>'error', 'code'=>0];

    	//查询这个大类是否存在，防止被人恶意添加
    	if(isset($_POST['c_id']) && isset($_POST["name"]) && strlen($_POST['name'])>0)
    	{
    		$status = b_category::get(['id'=>$_POST["c_id"]]);

    		if($status != null)
    		{
    			//判断这个小类是否存在
    			$status = b_category::get(['name'=>$_POST['name']]);

    			//如果小类不存在
    			if($status==null)
    			{
    				$model = self::$b_category;
    				$model->pid = $_POST['c_id'];
    				$model->name = $_POST['name'];
    				$s = $model->save();
    				if($s==1)
    				{
    					$json['message'] = 'success';
    					$json['code'] = 1;
    				}
    			}
    		}
    	}
    	echo json_encode($json);
    	return;
    }

}
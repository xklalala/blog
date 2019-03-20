<?php
namespace app\home\model;
use think\Model;

class article extends Model
{
	protected $table = 'b_article';

	public function get_hit()
	{
		var_dump("expression");
		var_dump("expression");
		var_dump("expression");
		var_dump("expression");
		var_dump("expression");
		echo "<hr/>";
		$m = new article();
		$data = $m->where(['status'=>1])->select();
		$data = $data->toArray();
		var_dump($data);
	}
	public function get_top_for_time()
	{

	}

}
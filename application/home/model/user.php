<?php
namespace app\home\model;
use think\Model;

class user extends Model
{
	protected $table = 'b_user';

	public static function get_user($string="")
	{
		var_dump($string);
		$list = new user();
		$data = $list->where('id in  ('.$string.')')->column('u_name', 'id');
		var_dump($data);
	}

}
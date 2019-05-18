<?php
namespace app\common\tools;
class Rds{
	private static $redis;
	private static $get_rds = null;
	private function __construct(){
		self::$redis = new \Redis();
		self::$redis->connect('127.0.0.1', 6379);
	}

	public function set($array, $time=1800){
		if(is_array($array))
		if(count($array)>0){
			$wd = 1;

			//判断数组维度
			foreach($array as $k)
				if(is_array($k))
					$wd = 2;

			foreach($array as $key=>$value)
			{
				if($wd == 2)
				{
					foreach($value as $k=>$v)
					{
						self::$redis->set($k, $v, $time);
					}
				}
				else
				{
					// self::$redis->set(json_encode($array));
					return self::$redis->set($key, $value, $time);
					
				}
			}
		}
		else
			return null;
	}

	public function get($str)
	{

		if(is_array($str))
		{
			$res = [];
			foreach($str as $value)
			{
				$res[$value] = self::$redis->get($value); 
			}
			return $res;
		}
		else
		{
			return self::$redis->get($str);
		}
	}

	public static function getRds(){
		if(!self::$get_rds instanceof self){
			self::$get_rds = new self();
		}
		return self::$get_rds;
	}
}
<?php
namespace app\common\tools;

//这里使用自定义session
class XS{
	private function __construct(){
		session_start();
		var_dump($_SESSION);
	}

	public static function set($name, $value){
		if(isset($name) && strlen(trim($name)) > 0)
			$_SESSION[$name] = $value;
		else
			return false;
	}

	public static function get($name){
		if(isset($_SESSION[$name]))
			return $_SESSION[$name];
		else
			return false;
	}
}
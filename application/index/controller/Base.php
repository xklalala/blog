<?php
namespace app\index\controller;

class Base{
	
	public function __construct(){
		header('Access-Control-Allow-Origin:*');
	}
}
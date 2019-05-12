<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function json($message = "", $code = 0) {
	$data = [
		'message' => $message,
		'code' => $code,
	];
	return json_encode($data);
}

function jsons($data = [], $message = "", $code = 0) {
	$data = [
		'data' => $data,
		'message' => $message,
		'code' => $code,
	];
	return json_encode($data);
}
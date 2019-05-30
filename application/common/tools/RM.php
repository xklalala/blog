<?php
namespace app\common\tools;
//这个类用来实现下面这个功能
// if($status){
//  	echo json_encode(['message'=>'ok', 'status'=>'1']);
//  }else{
//  	echo json_encode(['message'=>'发生了错误，请联系工作人员，或者重试几次', 'status'=>'0']);
//  }
class RM{
	public static function r($status, $success = 'ok', $error = '发生了错误，请联系工作人员，或者重试几次'){
		if(is_array($status) || $status){
			if(is_array($status)){
				if(count($status) == 0)
					$success = "没有数据";
				echo json_encode(['message'=>$success, 'status'=>'1', 'data'=>$status]);
			}else{
				echo json_encode(['message'=>'ok', 'status'=>'1']);
			}
		 	
		 }else{
		 	echo json_encode(['message'=>$error, 'status'=>'0']);
		 }
	}
}
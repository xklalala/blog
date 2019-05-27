<?php
namespace app\common\tools;


//判断post过来的数据是否合法

//这个只适合大于等于
//['name'=>['length'=>10]]
//或者等于
class XV{

	public static function v($array, $default=null)
	{
		foreach($array as $k=>$v)
		{
			if(is_array($v))
			{
				foreach($v as $key=>$value)
				{

					switch($key){
						case "len":
							$len = true;
							
							//判断是否相等
							if($default == null)
							{
								if(mb_strlen(trim($_POST[$k])) < $value){

									$len = false;
									$info = "至少需要位数：".$value;
								}
							}else if($default == 'eq')
							{
								if(mb_strlen(trim($_POST[$k])) != $value){

									$len = false;
									$info = "长度必须为".$value;
								}
							}
								
								// echo mb_strlen(trim($_POST[$k]))."  ".$value.'<br/>';
							if($len == false){
								echo json_encode(['message'=>"传过来的".$k."长度不合法, ".$info, 'status'=>0]);
								exit;
							}
							break;
					}
				}
			}
			else
			{
				if(!isset($_POST[$v]))
				{
					echo json_encode(['message'=>"参数".$v."不存在，请检查", 'status'=>"0"]);
					exit;
				}
				
			}
		}
	}
}
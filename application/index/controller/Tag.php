<?php
namespace app\index\controller;
use app\index\model\b_tag;

class Tag extends Base
{
	private static $b_tag;

	public function __construct()
	{
		self::$b_tag = new b_tag();
	}

	//新增标签
    public function addTag()
    {
    	$json = ['message'=>'error', 'code'=>0];
    	if(isset($_POST['tagName']) && strlen(trim($_POST['tagName']))>0)
    	{
    		$status = b_tag::get(['tagName'=>$_POST["tagName"]]);

    		if($status == null)
    		{
    			$model = self::$b_tag;
				$model->tagName = $_POST['tagName'];
				$s = $model->save();

				if($s==1)
				{
					$json['message'] = 'success';
					$json['code'] = 1;
				}
    		}
    	}
    	echo json_encode($json);
    	return;
    }

}
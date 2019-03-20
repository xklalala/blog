<?php
namespace app\home\controller;
use think\Controller;
use app\home\model\category;

class base extends controller
{
	public function nav()
	{
		$nav = category::all();
		$title = [];
		foreach($nav as $key=>$value)
		{
			if($value->c_id == 0)
			{
				$title[$key] ['p']= $value->title;
				$title[$key]['u'] = $value->url;
				unset($nav[$key]);
			}
			foreach($nav as $k=>$v)
			{
				if($value->id == $v->c_id)
				{
					$title[$key]['c'][] = $v->title;
					unset($nav[$k]);
				}
			}
		}
		return $title;
	}
}

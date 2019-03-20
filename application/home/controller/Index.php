<?php
namespace app\home\controller;
use think\Controller;
use app\home\model\article;


class index extends base
{
	public function _initialize()
	{
		$dz = new article();
		$dz->get_hit();
		$nav = $this->nav();
    	$this->assign('nav', $nav);
	}
    public function index()
    {
    	return view();
    }

    public function article_list()
    {
    	return view();
    }

    public function article_view()
    {
    	return view();
    }

    public function case_list()
    {
    	return view();
    }

    public function for_me()
    {
    	return view();
    }

    public function login()
    {
    	return view();
    }
    public function login_out()
    {

    }

    // public function 

}

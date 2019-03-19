<?php
namespace app\home\controller;
use think\Controller;


class index extends Controller
{
    public function index()
    {
    	return $this->nav();
    }

    public function nav()
    {
    	return view();
    }
}

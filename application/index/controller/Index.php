<?php
namespace app\index\controller;

class Index {
	public function addArticle()
	{

	}

	public function getWeater()
	{
		// var_dump($_SERVER);
		// http://www.ip138.com/ips138.asp?ip=39.106.158.118&action=2


		$weather = $this->get_data($this->get_weather_timeon());
		echo json_encode([
			'message'=>'success',
			'code'=>1, 
			'data'=>[
				'location'=>'江西师范大学',
				'condition'=>$weather->condition,
				'temp'=>$weather->temp.'℃',
				'wind'=>$weather->windDir,
				'updatetime'=>$weather->updatetime,
			]
		]);
		return;
	}

	function get_data($string, $id = 0)
	{
		$index = strpos($string, '{"');
	    $str = substr($string, $index);
	    $arr = json_decode($str);
	    if($id==1)
	    	return ($arr->data)->forecast;
	    
	    return ($arr->data)->condition;
	}

	private function get_weather_timeon()
	{

		$host = "http://apifreelat.market.alicloudapi.com";
	    $path = "/whapi/json/aliweather/briefcondition";
	    $method = "POST";
	    $appcode = "2b2a5b244af54b519fddc7446bdaf4cb";
	    $headers = array();
	    array_push($headers, "Authorization:APPCODE " . $appcode);
	    //根据API的要求，定义相对应的Content-Type
	    array_push($headers, "Content-Type".":"."application/x-www-form-urlencoded; charset=UTF-8");
	    $querys = "";
	    $bodys = "lat=28.6833736000&lon=116.0268639400&token=a231972c3e7ba6b33d8ec71fd4774f5e";
	    $url = $host . $path;

	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($curl, CURLOPT_FAILONERROR, false);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_HEADER, true);
	    if (1 == strpos("$".$host, "https://"))
	    {
	        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	    }
	    curl_setopt($curl, CURLOPT_POSTFIELDS, $bodys);
	    return curl_exec($curl);
	}
}

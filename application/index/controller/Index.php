<?php
namespace app\index\controller;

class Index {
		public function __construct(){
		header('Access-Control-Allow-Origin:*');
	}
	public function addArticle()
	{

	}

	public function getWeater()
	{
		if(
			isset($_POST['lng']) && $_POST['lng']>-180 && $_POST['lng']<180 &&
			isset($_POST['lat']) && $_POST['lat']<90 && $_POST['lat']>-90
		){
			$weather = $this->get_data($this->get_weather_timeon($_POST['lng'], $_POST['lat']));
			echo json_encode([
				'message'=>'success',
				'code'=>1, 
				'data'=>[
					// 'location'=>'江西师范大学',
					'condition'=>$weather->condition,
					'temp'=>$weather->temp.'℃',
					'wind'=>$weather->windDir,
					'updatetime'=>$weather->updatetime,
				]
			]);
			return;
		}

		
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

	private function get_weather_timeon($lng, $lat)
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
	    $bodys = "lat=".$lat."&lon=".$lng."&token=a231972c3e7ba6b33d8ec71fd4774f5e";
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


	//获得ip地址和地理地址
	public function getLocation(){
		$ip = $_SERVER['REMOTE_ADDR'];
		$url = "http://ip.tool.chinaz.com/".$ip;
		$str = $this->Curl($url);
		$start = mb_strpos($str, 'WhwtdWrap bor-b1s col-gray03');
		$str = mb_substr($str, $start, 400);
		$start = mb_strrpos($str, 'Whwtdhalf w50-0">') + mb_strlen('Whwtdhalf w50-0">');
		$end = mb_strrpos($str, '</span>');
		$str = mb_substr($str, $start, $end);
		$end = mb_strrpos($str, '</span>');
		$location = mb_substr($str, 0, $end);
		echo json_encode(['message'=>'success', 'code'=>1, 'data'=>['ip'=>$ip,'location'=>$location]]);
	}


	//随机ip地址
	private function Rand_IP(){
	    $ip2id= round(rand(600000, 2550000) / 10000); //第一种方法，直接生成
	    $ip3id= round(rand(600000, 2550000) / 10000);
	    $ip4id= round(rand(600000, 2550000) / 10000);
	    //下面是第二种方法，在以下数据中随机抽取
	    $arr_1 = array("218","218","66","66","218","218","60","60","202","204","66","66","66","59","61","60","222","221","66","59","60","60","66","218","218","62","63","64","66","66","122","211");
	    $randarr= mt_rand(0,count($arr_1)-1);
	    $ip1id = $arr_1[$randarr];
	    return $ip1id.".".$ip2id.".".$ip3id.".".$ip4id;
	}

	//抓取页面内容
	private function Curl($url){
        $ch2 = curl_init();
        $user_agent = "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.66 Safari/537.36";//模拟windows用户正常访问
        curl_setopt($ch2, CURLOPT_URL, $url);
        curl_setopt($ch2, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, array('X-FORWARDED-FOR:'.$this->Rand_IP(), 'CLIENT-IP:'.$this->Rand_IP()));
		//追踪返回302状态码，继续抓取
        curl_setopt($ch2, CURLOPT_HEADER, true); 
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

        curl_setopt($ch2, CURLOPT_NOBODY, false);
        curl_setopt($ch2, CURLOPT_REFERER, 'http://www.baidu.com/');//模拟来路
        curl_setopt($ch2, CURLOPT_USERAGENT, $user_agent);
        $temp = curl_exec($ch2);
        curl_close($ch2);
        return mb_convert_encoding($temp,'UTF-8', 'UTF-8,GBK,GB2312,BIG5');
	}
}

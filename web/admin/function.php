<?php
$ip = $_SERVER['REMOTE_ADDR'];
$url = "http://ip.tool.chinaz.com/".$ip;

//随机IP
function Rand_IP(){

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
function Curl($url){
        $ch2 = curl_init();
        $user_agent = "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.66 Safari/537.36";//模拟windows用户正常访问
        curl_setopt($ch2, CURLOPT_URL, $url);
        curl_setopt($ch2, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, array('X-FORWARDED-FOR:'.Rand_IP(), 'CLIENT-IP:'.Rand_IP()));
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
$str = Curl($url);
// echo $str;
$start = mb_strpos($str, 'WhwtdWrap bor-b1s col-gray03');
$str = mb_substr($str, $start, 400);
$start = mb_strrpos($str, 'Whwtdhalf w50-0">') + mb_strlen('Whwtdhalf w50-0">');
// var_dump($str);
$end = mb_strrpos($str, '</span>');
$str = mb_substr($str, $start, $end);
// var_dump($end);
$end = mb_strrpos($str, '</span>');
$location = mb_substr($str, 0, $end);
var_dump($location);
// if($location == "保留地址")
$url = "http://api.map.baidu.com/geocoder/v2/?address=".$location."&output=json&ak=eAjKgMVzrnxUUBz4G13bsdpeyQ3sLpUh&callback=showLocation";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="../public/js/jquery.min.js"></script>
	<script src="../public/js/config.js"></script>
</head>
<body>
<script type="text/javascript">
	var weather;
	$.ajax({
     url:"<?php echo $url;?>",
     dataType:'jsonp',
     processData: false, 
     type:'get',
     success:function(data){
     	if(data.status==0){
     		console.log(data.result.location.lng);
       		console.log(data.result.location.lat);
       		$.ajax({
       			url:url+"weather",
		     	type:'post',
		     	success:function(data){
		     		console.log(data);
		     	},
		     	error:function(XMLHttpRequest, textStatus, errorThrown) {
		     	}
		 	});
     	}
     },
     error:function(XMLHttpRequest, textStatus, errorThrown) {
     }});
</script>
</body>
</html>


<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:82:"/usr/share/nginx/html/blog/public/../application/home/view/index/article_view.html";i:1553048392;s:65:"/usr/share/nginx/html/blog/application/home/view/public/head.html";i:1553044579;s:64:"/usr/share/nginx/html/blog/application/home/view/public/nav.html";i:1553047922;s:67:"/usr/share/nginx/html/blog/application/home/view/public/footer.html";i:1552981385;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>lalala</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, height=device-height, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="http://39.106.158.118/static/layui/css/layui.css">
	<link rel="stylesheet" type="text/css" href="http://39.106.158.118/static/css/style.css">
	<script type="text/javascript" src="http://39.106.158.118/static/layui/layui.js"></script>
</head> 
<?php

// var_dump($nav);exit;
?>
<body>
<!-- 头部 开始 -->
<div class="layui-header header trans_3">
<div class="main index_main">
	<!-- <a class="logo" href="./index.html"><img src="./images/logo.png" alt="lalala"></a> -->
	<ul class="layui-nav" lay-filter="top_nav">
		<li class="layui-nav-item home"><a href="<?php echo url('index'); ?>">首页</a></li>
		<?php
			foreach($nav as $value)
			{?>
				
				<li class='layui-nav-item'><a href="<?php echo url($value['u']); ?>"><?php echo $value['p']; ?></a>
				
				<?php
				if(isset($value['c']))
				{
					echo '<dl class="layui-nav-child"> ';
					foreach($value['c'] as $v)
					{
						?>
						<dd><a href="<?php echo url($value['u']); ?>?t=<?php echo $v; ?>"><?php echo $v; ?></a></dd>
					<?php
					}
					echo '</dl>';
				}
				echo '</li>';
			}
		?>
		<li class="layui-nav-item home"><a href="<?php echo url('login'); ?>">login</a></li>
	</ul>
	<div class="title">lalala-blog</div>
	<form action="" mothod="post" class="head_search trans_3 layui-form">
	  <div class="layui-form-item trans_3">
	  	<!-- <span class="close trans_3"><i class="layui-icon">&#x1006;</i> </span> -->
	    <div class="layui-input-inline trans_3">
	      <select name="model_id trans_3">
	      	<option value="1" selected >文章</option>
	      	<option value="2">软件、资料</option>
	      </select>
	    </div>
	    <input type="text" name="keywords" placeholder="搜索" autocomplete="off" class="search_input trans_3">
	    <button class="layui-btn" lay-submit="" style="display: none;"></button>
	  </div>
		
	</form>
</div>
</div>
<div class="header_back"></div>
<!-- 头部 结束 -->
<!-- 左边导航 开始 -->
<div class="layui-side layui-bg-black left_nav trans_2">
  <div class="layui-side-scroll">
	<ul class="layui-nav layui-nav-tree"  lay-filter="left_nav">
		<li class="layui-nav-item home"><a href="/">首页</a></li>
	  	<li class="layui-nav-item">
	  		<a href="javascript:void();">学无止境</a>
			<dl class="layui-nav-child"> <!-- 二级菜单 -->
		      	<dd><a href="./article_list.html">PHP</a></dd>
		      	<dd><a href="./article_list.html">WEB前端</a></dd>
		    </dl>
	  	</li>
	  	<li class="layui-nav-item">
	  		<a href="javascript:void();">分享无价</a>
			<dl class="layui-nav-child"> <!-- 二级菜单 -->
		      	<dd><a href="./case_list.html">源码分享</a></dd>
		      	<dd><a href="./case_list.html">jQuery特效</a></dd>
		    </dl>
	  	</li>
	  	<li class="layui-nav-item">
	  		<a href="./diary.html">日记</a>
	  	</li>
	  	<li class="layui-nav-item">
	  		<a href="javascript:void();">关于</a>
			<dl class="layui-nav-child"> <!-- 二级菜单 -->
		      	<dd><a href="./about_lzcms.html">关于老张</a></dd>
		      	<dd><a href="./about_lzcms.html">关于Lz_CMS</a></dd>
		      	<dd><a href="./feedback.html">留言</a></dd>
		    </dl>
	  	</li>
	</ul>
  </div>
</div>
<div class="left_nav_mask"></div>
<div class="left_nav_btn"><i class="layui-icon">&#xe602;</i></div>
<!-- 左边导航 结束 -->




<!-- 底部 开始 --> 
<ul class="layui-fixbar">

	<li class="layui-icon layui-fixbar-top" id="to_top">&#xe604;</li>
</ul>
<div class="layui-footer footer">
  <div class="main index_main">
    <p><a href="http://www.xukai.ink">lalala</a> © www.xukai.ink</p>
<!--     <p>
      <a href="">网站地图</a>
    </p> -->
    <p class="beian">
 
    </p>
  </div>
</div>
<!-- 底部 结束 -->
<script type="text/javascript">
layui.use(['form','element'], function(){
	var layer = layui.layer,
	form = layui.form(),
	element = layui.element(),
	$ = layui.jquery;
  	
	//左边导航点击显示
	$('.left_nav_btn').click(function(){
		$('.left_nav_mask').show();
		$('.left_nav').addClass('left_nav_show');
	});
	//左边导航点击消失
	$('.left_nav_mask').click(function(){
		$('.left_nav').removeClass('left_nav_show');
		$('.left_nav_mask').hide();
	});

	//搜索框特效
	$('.header .head_search .search_input').focus(function(){
		$('.header .head_search').addClass('focus');
		$(this).attr('placeholder','输入关键词搜索');
	});
	$(document).click(function(){
		$('.header .head_search').removeClass('focus');
		$('.header .head_search .search_input').attr('placeholder','搜索');
	});
	$('.header .head_search').click(function(e){
		$(this).addClass('focus');
		e.stopPropagation(); 
	});
	/*$('.header .head_search .close').click(function(){
		$('.header .head_search').removeClass('focus');
		$('.header .head_search .search_input').attr('placeholder','搜索');
	});*/
	
	//回到顶部
	$("#to_top").click(function() {
      $("html,body").animate({scrollTop:0}, 200);
    });
    $(document).scroll(function(){
    	var	scroll_top = $(document).scrollTop();
    	if(scroll_top > 500){
    		$("#to_top").show();
    	}else{
    		$("#to_top").hide(); 
    	}
    }); 
    //底部版权始终在底部 
    /*var win_height = $(window).height();
    var body_height = $('body').height();  
    var footer_height = $('.footer').height();
    if(body_height - win_height < 0){
    	$('.footer').addClass('footer_fixed');
    } */
});
</script>
</body>
</html>
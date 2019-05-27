
	$.ajax({
	url:url + 'user/isLogin',
	type : 'post',
	data:{'userId':$.cookie('userId')},
	success:function(res){
		// console.log(typeof res,res);
		res = JSON.parse(res);
		console.log(res);
		if(res.code == "1"){
            document.getElementById('to-login').style.display = "none";
            document.getElementById('login-up').style.display = "block";
		}else{
			console.log("未登录")
			document.getElementById('to-login').style.display = "block";
            document.getElementById('login-up').style.display = "none";
		}
	},
	error:function(res){
		window.is_login = false;
	}
});



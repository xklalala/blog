
	$.ajax({
	url:url + 'user/isLogin',
	type : 'post',
	data:{'userId':$.cookie('userId')},
	success:function(res){
		res = JSON.parse(res);
		console.log(res);
		if(res.code = 1){
            document.getElementById('to-login').style.display = "none";
            document.getElementById('login-up').style.display = "block";
		}else{
			document.getElementById('to-login').style.display = "block";
            document.getElementById('login-up').style.display = "none";
		}
	},
	error:function(res){
		window.is_login = false;
	}
});



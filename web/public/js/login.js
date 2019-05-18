window.userId = false;
function login(){
    var user = document.getElementById('username').value;
    var pwd = document.getElementById('password').value;
    $.ajax({
    	type:"post",
		url:url+'user/login',
		data:{'name':user, 'password':pwd},
		success:function(res){
			console.log(res)
			res = JSON.parse(res);
			res = res.data;
			console.log(res);
			if(res.userId)
			{
				document.getElementById('to-login').style.display = "none";
				document.getElementById('login-up').style.display = "block";
				document.getElementById('user-name').innerHTML = user;
				$.cookie('user', user);
				$.cookie('userId', res.userId);
			}
			else{
				alert(res.message)
			}
		},
		error:function(res){
			console.log(res)
		}
    });
}
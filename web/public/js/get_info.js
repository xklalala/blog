$.ajax({
	url:url+'article/get_list',
	type:'post',
	success:function(res){
		res = JSON.parse(res);
		if(res.code == 1){
			str = "";
			for(i=0; i<res.data.length; i++){
				str += '<div class="article"><a style="cursor:pointer;" onclick="detail('+res.data[i].id+')"><h2>'+res.data[i].title+'</h2>';
				str += '<p>作者：'+res.data[i].u_name+'</p>';
				str += '<p>标签：'+res.data[i].t_id+'</p>';
				str += '<p>time：'+res.data[i].c_time+'</p>';
				str += '<p>阅读量：'+res.data[i].hit+'</p>';
				str += '<p>评论：'+res.data[i].common_num+'</p></a></div>';
			}
		   	str += '<div class="footer"><center>&copy;xk&nbsp;QQ:2607780909&nbsp;email:2607780909@qq.com</center></div>';
			document.getElementById('content').innerHTML = str;
			console.log(res);
		}else{
			alert(res.message);
		}
		
	}
});
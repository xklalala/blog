$.ajax({
	type:'post',
	url:url+'cate/get_d',
	success:function(res){
		res  = JSON.parse(res);
		// console.log(res)
		if(res.code==1){
			var str = "文章类型：<select name='articleType' id='articleTypes'>";
			for (i=0;i<res.data.length; i++){
				str += "<option value='"+res.data[i].id+','+res.data[i].name+"'>"+res.data[i].name+"</option>";
			}
			str += '</select>';
			document.getElementById('articleType').innerHTML= str;
		}
	},
	error:function(res){
	}
});

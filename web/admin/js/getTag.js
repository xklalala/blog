// var flag = false;
$.ajax({
	type:'get',
	url:url+'tag/get',
	success:function(res){
		res  = JSON.parse(res);
		// console.log(res)
		var str = "文章标签："
		if(res.code==1){
			for(var i=0, len=res.data.length; i<len; i++){
				str += '<label><input type="checkbox" name="tag" value="'+res.data[i].id+'"/>'+res.data[i].tagName+'</label>';
			}
			document.getElementById('tag').innerHTML = str;
			// flag = true;
		}
	},
	error:function(res){

	}
});
$.ajax({
	type:"post",
	url:url+'cate/get_cs',
	data:{},
	success:function(res)
	{
		var data = getJson(res);
		let nav = document.querySelector('#nav');
		let fragment = document.createDocumentFragment();

		for (let i = 0, length = data.length; i < length; i++)
		{
			let liNode = document.createElement('li');
			liNode.innerHTML = '<a href="#' + data[i].title+ '">' + data[i].title + '</a>';

			if (data[i].c_title !== null)
			{
				let ul = document.createElement('ul');
				for (let j = 0; j < data[i].c_title.length; j++)
				{
					let li = document.createElement('li');
					li.innerHTML = '<a href="#' + data[i].c_title[j] + '">' + data[i].c_title[j] + '</a>';
					ul.appendChild(li);
				}
				liNode.appendChild(ul);
			}
			fragment.appendChild(liNode);
		}
		nav.appendChild(fragment);
	},
	error:function(res){
		while(1){
			alert("对不起页面错误,请手动关闭此页面");
		}
	}
});


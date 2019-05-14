 function getJson($json){
	var data = JSON.parse($json);
	if(data.code == 0){
		alert(data.message)
		return false;
	}
	else
		return data.data;
}
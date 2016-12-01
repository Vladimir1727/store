function showSC(cat){
	if(cat=="0"){
		document.getElementById('subid').innerHTML='<option value="0">выберите категорию</option>';
	}
	if(window.XMLHttpRequest){
		ao=new XMLHttpRequest();
	}
	else{
		ao=new ActiveXObject('Microsoft.XMLHTTP');
	}
	ao.onreadystatechange=function(){
		if(ao.readyState==4 && ao.status==200){
			document.getElementById('subid').innerHTML=ao.responseText;
		}
	}
	ao.open('GET',"pages/ajax1.php?catid="+cat, true);
	ao.send(null);
	return false;
}

function showSC2(cat){
	if(cat=="0"){
		document.getElementById('subid2').innerHTML='<option value="0">выберите категорию</option>';
	}
	if(window.XMLHttpRequest){
		ao=new XMLHttpRequest();
	}
	else{
		ao=new ActiveXObject('Microsoft.XMLHTTP');
	}
	ao.onreadystatechange=function(){
		if(ao.readyState==4 && ao.status==200){
			document.getElementById('subid2').innerHTML=ao.responseText;
		}
	}
	ao.open('GET',"pages/ajax1.php?catid="+cat, true);
	ao.send(null);
	return false;
}

function showitem(id){
	if(id=="0"){
		document.getElementById('itemlist').innerHTML='<option value="0">выберите подкатегорию</option>';
	}
	if(window.XMLHttpRequest){
		ao=new XMLHttpRequest();
	}
	else{
		ao=new ActiveXObject('Microsoft.XMLHTTP');
	}
	ao.onreadystatechange=function(){
		if(ao.readyState==4 && ao.status==200){
			document.getElementById('itemlist').innerHTML=ao.responseText;
		}
	}
	ao.open('GET',"pages/ajax2.php?itemid="+id, true);
	ao.send(null);
	return false;
}


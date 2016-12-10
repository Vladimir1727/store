<form action="index.php?page=2" method="post">
	<!-- <select name="catid" class="pull-right"> -->
		<?php 

	/*	$pdo=Tools::connect();
		$ps=$pdo->prepare('select * from categories');
		$ps->execute();
		while ($row=$ps->fetch()){
		 	echo '<option value="'.$row['id'].'">'.$row['category'].'</option>';
		}
		echo '</select>';
		echo '<select name="subid" class="pull-right">';
		$ps=$pdo->prepare('select * from subcategories');
		$ps->execute();
		while ($row=$ps->fetch()){
		 	echo '<option value="'.$row['id'].'">'.$row['subcategory'].'</option>';

		}
		echo '</select>';*/
		include_once('pages/lists.html');
		echo '<div class=row>';
		$items=array();
		if (isset($_GET['sid'])){
			$items=Item::GetItems($_GET['sid']);
		}
		else{
			$items=Item::GetItems();
		}
		if(isset($GET['min']),$_GET['max']){
			$min=$GET['min'];
			$max=$GET['max'];
		}
		foreach ($items as $i) {
			if(isset($GET['min']),$_GET['max'])
			if ($i->GetPrice()<$min || $i->GetPrice()>$max) continue;
			$i->Draw();
		}
		echo '</div></form>';
		
$reguser='';
if (!isset($_SESSION['reg']) || $_SESSION['reg']=='') 
{
	$reguser='cart';
}
else
{
	$reguser=$_SESSION['reg'];
}

foreach ($_REQUEST as $k => $v) 
{
	if (substr($k,0,4) =='cart') 	
	{
		$iid=substr($k,4);
		echo '<script>document.cookie="'.$reguser.'_'.$iid.'='.$iid.'";</script>';
	}
}
 


 ?>
<script type="text/javascript">
	function getsubid(sid){
		document.location="index.php?page=2&sid="+sid;
			/*if (sub==""){

			document.getElementById('result').innerHTML="";
			return;
		}
		if (window.XMLHttpRequest) ae=new XMLHttpRequest();
		else ae=new ActiveXObject('Microsoft.XMLHTTP');
		ae.onreadystatechange=function(){
			if (ae.readyState==4 && ae.status==200)
				document.getElementById('result').innerHTML=ae.responseText;
		}
		ae.open('get','pages/lists.php?sub='+sub,true);
		ae.send(null);*/
	}
</script>
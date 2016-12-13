<?php 
		$issid='';
		if (isset($_GET['sid'])) $issid='&sid='.$_GET['sid'];
		echo '<form action="index.php?page=2'.$issid.'" method="post">';
		//фильтр по мин/макс
		echo "<h3>выберите диапазон:</h3>";
		echo '<div id="slider"></div>';
		$ps=$pdo->query('select MAX(pricesale) from items');
		$row=$ps->fetch(PDO::FETCH_LAZY);
		$bdmax=$row['MAX(pricesale)'];
		$ps=$pdo->query('select MIN(pricesale) from items');
		$row=$ps->fetch(PDO::FETCH_LAZY);
		$bdmin=$row['MIN(pricesale)'];

		if(isset($_GET['min'],$_GET['max'])){
			$min=$_GET['min'];
			$max=$_GET['max'];
			echo '<p>Показаны товары от '.$min.' до '.$max.' грн.</p>';
		}
		else{
			$min=$bdmin;
			$max=$bdmax;
		}
		echo '<p class="hide">Все товары от: <span id="bdmin">'.$bdmin.'</span> до: <span id="bdmax">'.$bdmax.'</span></p>';
		echo '<div>Выбран диапазон от: <span id="smin">'.$min.'</span> до <span id="smax">'.$max.'</span> грн.</div>';
		include_once('pages/lists.html');
		echo '<div class=row>';
		$items=array();
		if (isset($_GET['sid'])){
			$items=Item::GetItems($_GET['sid']);
		}
		else{
			$items=Item::GetItems();
		}
		
		foreach ($items as $i) {
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
		var min=document.getElementById('smin').innerHTML;
		var max=document.getElementById('smax').innerHTML;
		console.log('min='+min+"_max="+max);
		document.location="index.php?page=2&sid="+sid+'&min='+min+'&max='+max;
	}
</script>
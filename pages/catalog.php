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
		$items=Item::GetItems();
		foreach ($items as $i) {
			$i->Draw();
		}
		echo '</div></form>';
		 ?>

<?php 
foreach ($_REQUEST as $k => $v) {
	if(substr($k,0,4)=='cart'){
		$iid=substr($k,4);
		echo '<script>
		document.cookie="cart'.$iid.'='.$iid.'";</script>';
	}
}
 


 ?>
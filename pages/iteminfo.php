<?php
session_start();
include_once ("classes.php");
$id=$_GET['item'];
Tools::SetParam('localhost','root','123456','shop');
$pdo=Tools::connect();
$ps=$pdo->prepare('select * from items where id=?');
$ps->execute(array($id));
$row=$ps->fetch();
$info=$row['info'];
$imagepath=$row['imagepath'];
$itemname=$row['itemname'];
$pricesale=$row['pricesale'];
$but_reight='disabled';

if (isset($_SESSION['reg'])){
	$user=$_SESSION['reg'];
	$ps=$pdo->prepare('select * from sales where itemname=? and customername=?');
	$ps->execute(array($itemname,$user));
	$row=$ps->fetch();
	if ($row['customername']==$user) $but_reight='';
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title><?php echo $itemname; ?></title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet/less" href="../css/style.less">
	<style>
		select{
			height:32px;
		}
	</style>


</head>
<body>
	<div class='row'>
		<div class='col-md-3' id='itempic'>
			<img src="../<?php echo $imagepath; ?>" alt="">
		</div>
		<div class='col-md-9'>
			<h2 class="h2"><?php echo $itemname; ?></h2>
			<h2 class="h2 text-info">Цена: <span class="text-danger"><?php echo $pricesale; ?></span> грн.</h2>
			<form action="../index.php?page=2" method="post">
				<input type="submit" name="cart<?php echo $id ?>>" value="купить" class="btn btn-success">
			</form>
			<form action="iteminfo.php" method="get">
				<select name="rating" id="sel_r">
					<option value="0">оценка</option>
					<option value="1">очень плохо</option>
					<option value="2">плохо </option>
					<option value="3">нормально</option>
					<option value="4">хорошо</option>
					<option value="5">отлично</option>
				</select>
			 <input type="hidden" name="item" value="<?php echo $id; ?>">
				<input type="submit" name="feedback" value="голосовать"  class="btn btn-warning  <?php echo $but_reight; ?>" id="add_r">
			</form>
		</div>
	</div>	
	<div class="row" id="item_info">
		<div class='col-md-5'>
			<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="1500">
				<div class="carousel-inner" role="listbox">
					<?php
					$ps=$pdo->prepare('select imagepath from images where itemid=?');
					$ps->execute(array($id));
					$i=1;
					while ($row=$ps->fetch()) {
					if ($i==1) echo '<div class="item active">';
					else echo '<div class="item">';
					echo '<img src="../'.$row['imagepath'].'" alt="">';
					echo '</div>';
					$i++;
					}
					 ?>
				</div>
				<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
				</a>
			  	<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  	</a>
			</div>

		</div>
		<div class='col-md-7'>
			<p class="jumbotron"><?php echo $info; ?></p>
		</div>
	</div>
<?php 

if (isset($_GET['feedback'])){
	$ps=$pdo->prepare('update items set rate=? where id='.$id);
	$ps->execute(array($_GET['rating']));
	echo "<script>document.location='iteminfo.php?item=".$id."'</script>";
}
?>
<script src="../js/jquery-2.0.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/less.min.js"></script>
<script src="../js/info.js"></script>
</body>
</html>

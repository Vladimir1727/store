<?php
session_start();
//$_SESSION['reg']="Vova";
include_once ("pages/classes.php");
Tools::SetParam('localhost','root','123456','shop');
$pdo=Tools::connect();
if(isset($_GET['page'])){
	$page=$_GET['page'];
	}
 ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Купи-Купи интернет-магазин</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/jquery-ui.min.css">
	<link rel="stylesheet/less" href="css/style.less">
</head>
<body>
<?php 
include_once('pages/menu.php');
 ?>	
<main>
<?php
if(isset($_GET['page'])){
		if($page==1) include_once("pages/main.php");
		if($page==2) include_once("pages/catalog.php");
		if($page==3) include_once("pages/cart.php");
		if($page==4) include_once("pages/register.php");
		if($page==5) include_once("pages/admin.php");
	}
else include_once("pages/main.php");
 ?>
</main>
<footer>
	<p>
		<span class="glyphicon glyphicon-send"></span>
		<a href="">Условия доставки</a>
	</p>
	<p>
		<span class="glyphicon glyphicon-credit-card"></span>
		<a href="">Условия оплаты</a>
	</p>
	<p>
		<span class="glyphicon glyphicon-phone-alt"></span>
		<a href="">Контакты</a>
	</p>
	<p class="text-center">
		<span class="glyphicon glyphicon-copyright-mark"></span>
		Diamandy production
	</p>
	
	
</footer>
<script src="js/jquery-2.0.0.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/less.min.js"></script>
<script src="js/ajax.js"></script>
<script src="js/script.js"></script>
</body>
</html>
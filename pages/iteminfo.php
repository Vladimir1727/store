<?php
include_once ("classes.php");
$id=$_GET['item'];
Tools::SetParam('localhost','root','123456','shop');
$pdo=Tools::connect();
$ps=$pdo->prepare('select * from items where id=?');
$ps->execute(array($id));
//$ps=$pdo->query('select * from items where id=5');
$row=$ps->fetch();
echo $row['info'];


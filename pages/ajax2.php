<?php
include_once('classes.php');
$itemid=$_GET['itemid'];
Tools::SetParam('localhost','root','123456','shop');
$pdo=Tools::connect();
$sel=$pdo->prepare('select id,itemname from items where id='.$itemid);
$sel->execute();
echo '<option value=0>выберите товар</option>';
while ($row=$sel->fetch(PDO::FETCH_LAZY)){
	echo '<option value='.$row['id'].'>'.$row['itemname'].'</option>';
}
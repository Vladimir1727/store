<?php
include_once('classes.php');
$catid=$_GET['catid'];
Tools::SetParam('localhost','root','123456','shop');
$pdo=Tools::connect();
$sel=$pdo->prepare('select * from subcategories where catid='.$catid);
$sel->execute();
echo '<option value=0>Выберите подкатегорию</option>';
while ($row=$sel->fetch(PDO::FETCH_LAZY)){
	echo '<option value='.$row['id'].'>'.$row['subcategory'].'</option>';
}
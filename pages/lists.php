<?php 
include_once('classes.php');
Tools::SetParam('localhost','root','123456','shop');
//if (isset($_GET['cat']))
$cat=$_GET['cat'];
$pdo=Tools::connect();
$ps=$pdo->prepare('select * from subcategories
	where catid=?');
$ps->execute(array($cat));
echo '<select name="subid" id="subid"  class="form-control" onchange=getsubid(this.value)>';
echo '<option value="0">выберите подкатегорию</option>';
while ($row=$ps->fetch()){
	echo '<option value="'.$row['id'].'">'.$row['subcategory'].'</option>';
}
echo '</select>';
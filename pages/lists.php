<?php 
include_once('classes.php');
Tools::SetParam('localhost','root','123456','shop');
$cat=$_GET['cat'];
$pdo=Tools::connect();
$ps=$pdo->prepare('select * from subcategories
	where catid=?');
$ps->execute(array($cat));
echo '<select name="subid" id="subid"  class="form-control">';
while ($row=$ps->fetch()){
	echo '<option value="'.$row['id'].'">'.$row['subcategory'].'</option>';
}
echo '</select>';
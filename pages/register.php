<?php 
if (isset($_REQUEST['adduser'])) {
	$login=trim($_REQUEST['login']);
	$pass=trim($_REQUEST['pass1']);
	if ($login=='' || $pass==''){
		echo 'не заполнены обязательные поля';
		exit();
	}
	$path='';
	if (is_uploaded_file($_FILES['avatar']['tmp_name'])){
		move_uploaded_file($_FILES['avatar']['tmp_name'],'img/'.$_FILES['avatar']['name']);
	$path='img/'.$_FILES['avatar']['name'];
	}
	echo 'pass='.$pass;
	$customer=new Customer($login,$pass,$path);
	$customer->IntoDb();
}
else{
?>

<form action="index.php?page=4" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="login">Логин</label>
		<input type="text" id="login" class="form-control" name="login">
	</div>
	<div class="form-group">
		<label for="pass1">Пароль</label>
		<input type="password" id="pass1" class="form-control" name="pass1">
	</div>
	<div class="form-group">
		<label for="pass2">Подтверждение пароля</label>
		<input type="password" id="pass2" class="form-control"  name="pass2">
	</div>
	<!-- <div class="form-group">
		<label for="email">E-mail</label>
		<input type="email" id="email" class="form-control" name="email">
	</div> -->
	<input type="file" name="avatar" class="form-control">
	<input type="submit" class="btn" name="adduser" id="adduser">
</form>

<?php
}
?>
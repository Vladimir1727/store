<?php 
$enterform='<form class="navbar-form navbar-left" method="post" action="index.php">
    <div class="form-group">
    	<input type="text" class="form-control" placeholder="логин..." id="login0" name="login0">
        <input type="password" class="form-control" placeholder="пароль..." id="pass0" name="pass0">
    </div>
      	<button type="submit" class="btn btn-default" id="enter" name="enter">
      		<span class="glyphicon glyphicon-log-in"></span>
      		Войти
      	</button>
</form>';
if (isset($_SESSION['reg'])){
	echo '<span id="enter_name">Привет, <strong>'.$_SESSION['reg'].'<strong></span>';
	echo '<form class="navbar-form navbar-left" method="post" action="index.php">
			<button  class="btn btn-default" id="exit" name="exit" type="submit">Выйти</button>
			</form>';
}
else{
	echo $enterform;
}

if (isset($_POST['exit'])) {
	unset($_SESSION['reg']);
}

if (isset($_POST['enter'])) {
	$ps=$pdo->prepare('select * from customers where login=? and pass=?');
	//$_SESSION['reg']=$_POST['pass0'];
	$ps->execute(array($_POST['login0'],$_POST['pass0']));
	$row=$ps->fetch(PDO::FETCH_LAZY);
	$_SESSION['reg']=$row['login'];
}
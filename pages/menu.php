<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php?page=1">Купи-Купи</a>

    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
      	<li <?php echo ($page==2)? "class='active'":"" ?>>
	      	<a href="index.php?page=2">
	      		<span class="glyphicon glyphicon-th-list"></span>
	      		Каталог
	      	</a>
      	</li>
				<li <?php echo ($page==3)? "class='active'":"" ?>>
					<a href="index.php?page=3">
						<span class="glyphicon glyphicon-shopping-cart"></span>
						Корзина
					</a>
				</li>
				<li <?php echo ($page==4)? "class='active'":"" ?>>
	        		<a href="index.php?page=4">
	         		<span class="glyphicon glyphicon-user"></span>
	         		Регистрация 
	         	</a>
				<?php
		         	if ($_SESSION['reg']=="admin"){
		         	echo "</li><li";
					echo ($page==5)? "class='active'":"";
					echo "><a href='index.php?page=5'><span class='glyphicon glyphicon-wrench'>
							</span>Админ</a></li>";
					}
				?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        
       	<?php include_once("pages/enter.php"); ?>
      </ul>
    	
    </div>
  </div>
</nav>
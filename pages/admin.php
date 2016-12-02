<div id="tabs">
  <ul>
    <li><a href="#fragment-1">Категории</a></li>
    <li><a href="#fragment-2">Товары</a></li>
    <li><a href="#fragment-3">Картинки</a></li>
  </ul>
  <div id="fragment-1" class="row">
    <div class="col-md-6 col-sm-12">
	    <h3>Категории</h3>
		<form action="index.php?page=5" method="post" class="form-inline">
			<input type="text" placeholder="категория..." name="newcat"  class="form-control"  id="input_cat">
			<input type="submit" value="Добавить" name="addcat" class="btn btn-default" id="add_cat">
		</form>
		<?php 
		if (isset($_POST['addcat'])){
			$newcat=trim($_POST['newcat']);
			if($newcat!=""){
				$ins=$pdo->prepare('insert into categories(category) values(:category)');
				$data=array('category'=>$newcat);
				$ins->execute($data);
			}
		}
		 ?>
	</div>
	<div class="col-md-6 col-sm-12">
    	<h3>Подкатегории</h3>
    	<form action="index.php?page=5" method="post" class="form-inline">
    		<select name="cat" id="sel_cat1">
    			<option value="0">выберите категорию</option>
    			<?php 
    			$sel=$pdo->prepare('select * from categories');
				$sel->execute();
				while ($row=$sel->fetch(PDO::FETCH_LAZY)){
					echo '<option value='.$row['id'].'>'.$row['category'].'</option>';

				}
    			?>
    		</select>
    		<input  type="text" placeholder="подкатегория..." name="newsub" class="form-control" id="input_sub">
    		<input type="submit" value="Добавить" name="addsub" class="btn btn-default" id="add_sub">
    	</form>
    	<?php 
    	if (isset($_POST['addsub'])){
			$newsub=trim($_POST['newsub']);
			$catid=$_POST['cat'];
			if($newsub!="" && $catid>0){
				$ins=$pdo->prepare('insert into subcategories(subcategory,catid) values(:subcategory,:catid)');
				$data=array('subcategory'=>$newsub,'catid'=>$catid);
				$ins->execute($data);
			}
		}
    	 ?>
    </div>
  </div>
  <div id="fragment-2">
    <h3>Добавить товар</h3>
    <form action="index.php?page=5#fragment-2" method="post" class="input-group"  enctype="multipart/form-data">
    	<div class="input-group">
    	<select name="catid" id="sel_cat2" onchange="showSC(this.value)">
	    <option value="0">Выберите категорию</option>
	    	<?php 
	    		$sel=$pdo->prepare('select * from categories');
				$sel->execute();
				while ($row=$sel->fetch(PDO::FETCH_LAZY)){
					echo '<option value='.$row['id'].'>'.$row['category'].'</option>';
				}
				?>
	    </select>
	    <select name="subid" id="subid"></select>
	    </div>
	    <div class="input-group">
	    	<label for="itemname" class="input-group-addon">Наименование</label>
	    	<input type="text" placeholder="наименование..." name="itemname" id="itemname" class="form-control">
    	</div>
    	<div class="input-group">
    		<label for="pricein" class="input-group-addon">Цена покупки:</label>
    		<input type="text" placeholder="цена покупки..." name="pricein" id="pricein" class="form-control">
    		<label for="pricesale" class="input-group-addon">Цена продажи:</label>
    		<input type="text" placeholder="цена продажи..." name="pricesale" id="pricesale" class="form-control">
    	</div>
    	<div class="input-group">
	    	<label for="itempic" class="input-group-addon">Главная картинка товара:</label>
	    	<input type="file" name="itempic" id="itempic" class="form-control">
    	</div>
    	<textarea name="info" id="info" placeholder="описание..." class="form-control">
		</textarea>
		<input type="submit" name="additem" value="Добавить" class="btn btn-default" id="add_item">
		</form>
	<?php 
    	if (isset($_POST['additem'])){
			if (is_uploaded_file($_FILES['itempic']['tmp_name'])){
				move_uploaded_file($_FILES['itempic']['tmp_name'],'img/'.$_FILES['itempic']['name']);
				$path='img/'.$_FILES['itempic']['name'];
			}
    		$idata=array('id'=>0,
    			'itemname'=>$_POST['itemname'],
    			'catid'=>$_POST['catid'],
    			'subid'=>$_POST['subid'],
    			'pricein'=>$_POST['pricein'],
    			'pricesale'=>$_POST['pricesale'],
    			'info'=>$_POST['info'],
    			'imagepath'=>$path
    			);
			$newitem = new Item($idata);
			$newitem->intoDB();
		}
    	 ?>
  </div>
  <div id="fragment-3">
  	<h3>Добавить картинки к товару</h3>
    <form action="index.php?page=5#fragment-3" method="post" class="input-group"  enctype="multipart/form-data">
    	<div class="input-group">
    		<select name="catid" id="sel_cat3" onchange="showSC2(this.value)">
    		<option value="0">Выберите категорию</option>
	    		<?php 
	    			$sel=$pdo->prepare('select * from categories');
					$sel->execute();
					while ($row=$sel->fetch(PDO::FETCH_LAZY)){
						echo '<option value='.$row['id'].'>'.$row['category'].'</option>';
					}
				?>
	    	</select>
	    	<select name="subid" id="subid2" onchange="showitem(this.value)"></select>
			<select name="itemlist" id="itemlist"></select>
		</div>
		<div class="input-group">
			<input type="file" name="file[]" multiple accept="image/*" class="form-control"  id="files">
    	</div>
    	<input type="submit" name="addpics" value="Добавить" class="btn btn-default" id="addpics">
    </form>
	<?php 
    	if (isset($_POST['addpics']) && $_POST['itemlist']>0){
    		$i=0;
    		$str="insert into images(itemid,imagepath) values";
    		foreach($_FILES['file']['name'] as $k => $v) {
    			if($_FILES['file']['error'][$k] !=0){
					echo '<script>alert("неправильный размер файла'.$v.'")</script>';
					continue;
				}
				if(move_uploaded_file($_FILES['file']['tmp_name'][$k],'img/'.$v)){
					if ($i>0){
					$str.=",";
					}
					$i++;
					$str.="(".$_POST['itemlist'].",'img/".$v."')";
				}
			}
			if ($i>0){
				$ins=$pdo->prepare($str);
				$ins->execute();
			}
		}
    	 ?>

  </div>
</div>
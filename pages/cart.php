<?php
echo '<form action="index.php?page=3" method="post">';
echo '<div class="row">';
$reguser='';
            if (!isset($_SESSION['reg']) || $_SESSION['reg']=='') {
                $reguser='cart';
            }
            else{
                $reguser=$_SESSION['reg'];
            }
            $total=0;
            foreach ($_COOKIE as $k => $v) {

              if (strpos($k,$reguser)===0) 
              {
                    $pos=strpos($k,'_');
                    $iid=substr($k,$pos+1);
                    $item=Item::fromDb($iid);
                    $item->DrawCart();
                    $total+=$item->getPrice();
               }
            }
echo '<div class="col-md-12"><h2>'.$total.'</h2>';
echo '<button type="submit" name ="subbuy" class="btn btn-success">Купить</button>';
echo '</div></div></form>';
if (isset($_POST['subbuy'])){
	foreach ($_COOKIE as $k => $v) {
		if(strpos($k,$reguser)===0){
			$pos=strpos($k,'_');
			$_SESSION['err']=substr($k,$pos);
			$id=substr($k,$pos+1);
			$item=Item::fromDb($id);
			echo $item->GetPrice();
			
			$item->Sale();
		}
	}
}
 echo '<h1>'.$_SESSION['err'].'</h1>';
echo '<h1>'.$_SESSION['reg'].'</h1>';



?>

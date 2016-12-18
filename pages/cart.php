<script>
	function deleteCookie(rname){
	var cookies=document.cookie.split(';');
	for (var i = 1; i <= cookies.length; i++){
		cookies[i-1]=cookies[i-1].trim();
		if (cookies[i-1].indexOf(rname)===0){
			var cookie=cookies[i-1].split('=');
			var d=new Date(new Date().getTime()-100);
			document.cookie=cookie[0]+"="+"0"+";path=/store;expires="+d.toUTCString();
		}
	}
}
</script>
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
echo '<div class="col-md-12"><h2>Итого: '.$total.' грн.</h2>';
echo '<button type="submit" name ="subbuy" class="btn btn-success">Купить</button>';
echo '</div></div></form>';
if (isset($_POST['subbuy'])){
	foreach ($_COOKIE as $k => $v) {
		if(strpos($k,$reguser)===0){
			$pos=strpos($k,'_');
			
			$id=substr($k,$pos+1);
			$item=Item::fromDb($id);
			$item->Sale();
		}
	}
	echo '<script> deleteCookie("'.$reguser.'");</script>';
	echo "<script>document.location='index.php?page=3'</script>";
}
?>


<?php
echo '<div class="row">';
foreach ($_COOKIE as $k => $v) {
	if(substr($k,0,4)=='cart'){
		$iid=substr($k,4);
		$item=item::fromDb($iid);
		$item->Draw();
	}
}
echo '</div>';
 ?>
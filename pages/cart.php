корзина
<?php
$data=array('itemname'=>'телевизор 1',
			'catid'=>1,
			'subid'=>1,
			'pricein'=>1000,
			'pricesale'=>1500,
			'info'=>'маленький телевизор',
			'rate'=>0,
			'imagepath'=>'images/1.jpg',
			'action'=>0);
$i=new Item($data);
$i->IntoDb();
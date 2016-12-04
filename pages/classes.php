<?php 

class tools
{
	static private $param;
	static function setparam($host,$user,$pass,$dbname){
		tools::$param=array($host,$user,$pass,$dbname);
	}
	static function connect(){
		$dsn='mysql:host='.tools::$param[0].';dbname='.tools::$param[3].';charset=utf8;';//строка подключения
		$options=array(
			PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,//при ошибке - прерывать работу и сигнализировать об ошибке
			PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,//получание данных в ассоциативном массиве
			PDO::MYSQL_ATTR_INIT_COMMAND=>'set names "utf8"',
			);//массив параметров для PDO
		$pdo = new PDO($dsn,tools::$param[1],tools::$param[2],$options);
		return $pdo;
	}
}
//////////////////////////////////////////////
class Customer{
	protected $id;
	protected $login;
	protected $pass;
	protected $roleid;
	protected $discount;
	protected $total;
	protected $imagepath;

	function __construct($login,$pass,$imagepath,$id=0){
		if ($imagepath=='') $imagepath='images/loading.gif';
		$this->login=$login;
		$this->pass=$pass;
		$this->imagepath=$imagepath;
		$this->id=$id;
		$this->discount=0;
		$this->total=0;
		$this->roleid=2;
	}

	function IntoDb(){
		Tools::SetParam('localhost','root','123456','shop');
		$pdo=Tools::connect();
		$ps=$pdo->prepare('insert into customers(login,pass,roleid,discount,total,imagepath)
			values (:login,:pass,:roleid,:discount,:total,:imagepath)');
		$data=array('login'=>$this->login,'pass'=>$this->pass,'roleid'=>$this->roleid,'discount'=>$this->discount,'total'=>$this->total,'imagepath'=>$this->imagepath);
		$ps->execute($data);
	}
	static function FromDb($id){
		Tools::SetParam('localhost','root','123456','shop');
		$pdo=Tools::connect();
		$ps=$pdo->prepare('select * from customers where id=?');
		$ps->execute(array($id));
		$row=$ps->fetch(PDO::FETCH_LAZY);//получаем значения при обращении к массиву
		$customer=new Customer($row['login'],$row['pass'],$row['imagepath'],$id);
		return $customer;
	}
}
////////////////////////////////////////////////////
class Item{
	protected $id,$itemname,$catid,$subid,$pricein,$pricesale,$info,$rate,$imagepath,$action;
	function __construct(array $data){
		$this->id=$data['id'];
		$this->itemname=$data['itemname'];
		$this->catid=$data['catid'];
		$this->subid=$data['subid'];
		$this->pricein=$data['pricein'];
		$this->pricesale=$data['pricesale'];
		$this->info=$data['info'];
		$this->imagepath=$data['imagepath'];
		$this->action=0;
		$this->rate=0;
	}
	function IntoDb(){
		Tools::SetParam('localhost','root','123456','shop');
		$pdo=Tools::connect();
		$ps=$pdo->prepare('insert into Items(itemname,catid,subid,pricein,pricesale,info,rate,imagepath,action)
			values (:itemname,:catid,:subid,:pricein,:pricesale,:info,:rate,:imagepath,:action)');
		$data=array('itemname'=>$this->itemname,
			'catid'=>$this->catid,
			'subid'=>$this->subid,
			'pricein'=>$this->pricein,
			'pricesale'=>$this->pricesale,
			'info'=>$this->info,
			'rate'=>$this->rate,
			'imagepath'=>$this->imagepath,
			'action'=>$this->action);
		$ps->execute($data);
	}
	static function fromDb($id){
		$item=null;
		try{
			$pdo=Tools::connect();
			$ps=$pdo->prepare('select * from Items where id=?');
			$ps->execute(array($id));
			$row=$ps->fetch();
			$data=array('id'=>$row['id'],
				'itemname'=>$row['itemname'],
				'catid'=>$row['catid'],
				'subid'=>$row['subid'],
				'pricein'=>$row['pricein'],
				'pricesale'=>$row['pricesale'],
				'info'=>$row['info'],
				'rate'=>$row['rate'],
				'imagepath'=>$row['imagepath'],
				'action'=>$row['action']);
			$item=new Item($data);
			return $item;
		}
		catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}

	function Draw(){
		echo '<div class="col-sm-2" style="height:250px;border:1px #ddd solid;padding 5px;box-sizing:border-box">';
		echo '<h5 style="color:blue;font-size:9pt;text-align:center;display:block;height:40px;font-weight:800">'.$this->itemname.'</h5>';
		echo '<div style="height:100px"><img src="'.$this->imagepath.'" style="max-height:100px;max-width:80px"><span class="pull-right" style="color:red;font-size:14pt">'.$this->pricesale.'грн.</span></div>';
		echo '<div style="background-color:lightyellow;color:darkgreen;overflow:hidden;height:50px;font-size:8pt">'.$this->info.'</div>';
		echo '<div><input class="btn btn-success" name="cart'.$this->id.'" type="submit" value="в корзину"><a href="pages/iteminfo.php?item='.$this->id.'" class="pull-right btn btn-warning">Инфо</a>
			
			</div>';
		echo '</div>';
	}

	static function GetItems(){
		$pdo=Tools::connect();
		$ps=$pdo->prepare('select * from items');
		$items=array();
		$ps->execute();
		while($row=$ps->fetch()){
			$data=array('id'=>$row['id'],
				'itemname'=>$row['itemname'],
				'catid'=>$row['catid'],
				'subid'=>$row['subid'],
				'pricein'=>$row['pricein'],
				'pricesale'=>$row['pricesale'],
				'info'=>$row['info'],
				'rate'=>$row['rate'],
				'imagepath'=>$row['imagepath'],
				'action'=>$row['action']);
			$i=new Item($data);
			$items[]=$i;
		}
		return $items;

	}
}